<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use DB;
use App\Models\Host;
use App\Models\Type;
use App\Models\Owner;
class PostController extends Controller
{
        public function __construct(){
            $this->middleware('auth');
        }
        /**
         * 显示文章列表.
         *
         * @return Response
         */
        public function index()
        {
            $host_list =Host::leftJoin('types','hosts.type_id','=','types.id')
            ->leftJoin('owners','hosts.owner_id','=','owners.id')
            ->select('hosts.id','hosts.name','hosts.ip','types.name as type','owners.name as owner','ver')
            ->simplepaginate(10);
            //$host_list = Host::find(3)->types;           
            //$host_list = Type::find(2)->hosts()->get();
            //dd($host_list);
            $createUrl = route('post.create');
            $gettypeUrl = route('post.gettype');
            $getownerUrl = route('post.getowner');
            $postUrl = Route('post.search'); 
            $csrf_field =  csrf_field();           
            return view('post.show_all_list',[
            'lists' => $host_list,
            'createUrl' => $createUrl,
            'gettypeUrl' => $gettypeUrl,
            'getownerUrl' => $getownerUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field
            ]);
        }

        /**
         * 创建新文章表单页面
         *
         * @return Response
         */
        public function create()
        {
            //
            $postUrl = route('post.store');
            $showUrl = route('post.index');
            $type_list =Type::all();
            $owner_list =Owner::all();
            $csrf_field = csrf_field(); 
            return view('post.post_create',[
            'showUrl' => $showUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field,
            'type_list' => $type_list,
            'owner_list' => $owner_list
            ]);      

        }

        /**
         * 将新创建的文章存储到存储器
         *
         * @param Request $request
         * @return Response
         */
        public function store(Request $request)
        {
            //
            $hosts = $request->input('hosts');
            $ip = $request->input('ip');
            $type_id = $request->input('type');
            $owner_id = $request->input('owner');
            $a = Host::where('name','$hosts')->first();
            if(empty($hosts))
            {
                exit('Enter is Empty');
            }
            if(!empty($a))
            {
                exit('Data is exist!');
            }
            $host = new Host;
            $host->name = $hosts;
            $host->ip = $ip;
            $host->type_id = $type_id;
            $host->owner_id = $owner_id;
            $host->save();
            return redirect()->route('post.index');             
        }


        /**
         * 显示指定文章 
         * 该功能未使用
         * @param int $id
         * @return Response
         */
        public function show($id)
        {
            /*
            $list = DB::table('cmdb_list_all')
                ->where('cmdb_list_all.id',$id)
                ->leftJoin('cmdb_hosts','cmdb_list_all.hosts_id','=','cmdb_hosts.id')
                ->leftJoin('cmdb_ip','cmdb_list_all.ip_id','=','cmdb_ip.id')
                ->leftJoin('cmdb_owner','cmdb_list_all.owner_id','=','cmdb_owner.id')
                ->get();
            if($list->isEmpty()){
                return 'Nothing Found!';
            }else{
                $editUrl = route('post.edit',$id);
                $showUrl = route('post.index');               
                return view('post.show_one',['list' => $list, 'showUrl' => $showUrl,'editUrl' => $editUrl]);                    
            }
            */
        }

        /**
         * 显示编辑指定文章的表单页面
         *
         * @param int $id
         * @return Response
         */
        public function edit($id)
        {
            //
            $hosts = Host::find($id);
             if(Empty($hosts)){
                exit('Host is not found');
            }
            $type_list =Type::all();
            $owner_list =Owner::all();            
            $postUrl = route('post.update',$id);
            $showUrl = route('post.index');  
            $csrf_field = csrf_field();
            return view('post.update_hosts',[
            'lists' => $hosts,
            'showUrl' => $showUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field,
            'type_list' => $type_list,
            'owner_list' => $owner_list            
            ]);  

           
        }

        /**
         * 在存储器中更新指定文章
         *
         * @param Request $request
         * @param int $id
         * @return Response
         */
        public function update(Request $request, $id)
        {
            //
            $hosts = $request->input('hosts');
            $ip = $request->input('ip');
            $type_id = $request->input('type');
            $owner_id = $request->input('owner');
            $host = Host::find($id);
            $host->name = $hosts;
            $host->ip = $ip;
            $host->type_id = $type_id;
            $host->owner_id = $owner_id;
            $host->save();
            return redirect()->route('post.index');  
        }

        /**
         * 从存储器中移除指定文章
         *
         * @param int $id
         * @return Response
         */
        public function destroy($id)
        {
            //
            Host::destroy($id);
            return redirect()->route('post.index');
        }
        
        /**
         * 按主机名搜索
         *
         * @return Response
         */
        public function search(Request $request)
        {
            $hosts = $request->input('hosts');
            $host_list = Host::where('hosts.name','like','%'.$hosts.'%')
            ->leftJoin('types','hosts.type_id','=','types.id')
            ->leftJoin('owners','hosts.owner_id','=','owners.id')
            ->select('hosts.id','hosts.name','hosts.ip','types.name as type','owners.name as owner')
            ->simplepaginate(10);
            $showUrl = route('post.index');        
            return view('post.search_hosts',[
            'lists' => $host_list,
            'showUrl' => $showUrl,   
            'hosts' => $hosts 
            ]);
        }   
                    
        public function gettype()
        {
            //
            //$ip_list = DB::table('cmdb_ip')->simplePaginate(10);
            $type_list = Type::paginate(10);
            $showUrl = route('post.index'); 
            return view('post.get_type',['lists' => $type_list, 'showUrl' => $showUrl]);  
        }
        
        public function getowner()
        {
            //
            //$ip_list = DB::table('cmdb_owner')->simplePaginate(10);
            $owner_list = Owner::simplePaginate(10);
            $showUrl = route('post.index'); 
            return view('post.get_owner',['lists' => $owner_list, 'showUrl' => $showUrl]);  
        }   
        
        public function addtype()
        {
            //
            $postUrl = route('post.storetype');            
            $showUrl = route('post.gettype'); 
            $csrf_field = csrf_field(); 
            return view('post.add_type',[
            'postUrl' => $postUrl, 
            'showUrl' => $showUrl,
            'csrf_field' =>$csrf_field
            ]);  
        }     
        
        public function addowner()
        {
            //
            $postUrl = route('post.storeowner');            
            $showUrl = route('post.getowner'); 
            $csrf_field = csrf_field(); 
            return view('post.add_owner',[
            'postUrl' => $postUrl, 
            'showUrl' => $showUrl,
            'csrf_field' =>$csrf_field
            ]);  
        }  
           
        public function storetype(Request $request)
        {
            $text = $request->input('type');
            $id = Type::where('name',$text)->first();
            if(!empty($id))
                {   
                    exit('Data is exist');
                }
            if(empty($text))
                {
                    exit('Empty');
                }
            $type = new Type;
            $type->name = $text;
            $type->save();
            return redirect()->route('post.gettype');            
        }  

        public function storeowner(Request $request)
        {
            $text = $request->input('owner');
            $id = Owner::where('name',$text)->first();
            if(!empty($id))
                {   
                    exit('Data is exist');
                }
            if(empty($text))
                {
                    exit('Empty');
                }
            $owner = new Owner;
            $owner->name = $text;
            $owner->save();
            return redirect()->route('post.getowner');                        
        }
        
        public function typeupdate(Request $request, $id)
        {
            $a = Type::find($id);
            $a->name = $request->input('type');
            $a->save();
            return redirect()->route('post.gettype');              
        }  

        public function ownerupdate(Request $request, $id)
        {
            $a = Owner::find($id);
            $a->name = $request->input('owner');
            $a->save();
            return redirect()->route('post.getowner');       
        }  

        public function edittype($id)
        {
            $type = Type::find($id);
            $postUrl = route('post.typeupdate',$id);            
            $csrf_field = csrf_field(); 
            return view('post.update_type',[
            'lists' => $type,
            'postUrl' => $postUrl, 
            'csrf_field' =>$csrf_field
            ]);                     
        }  

        public function editowner($id)
        {
            $owner = Owner::find($id);
            $postUrl = route('post.ownerupdate',$id);            
            $csrf_field = csrf_field(); 
            return view('post.update_owner',[
            'lists' => $owner,
            'postUrl' => $postUrl, 
            'csrf_field' =>$csrf_field
            ]);  
        }      
}
