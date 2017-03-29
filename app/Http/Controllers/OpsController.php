<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use DB;
use App\Models\Group;
use App\Models\Groups_host;
use App\Models\Host;
use App\Models\File;
class OpsController extends Controller
{
        public function __construct(){
            $this->middleware('auth');
        }
        
        public function index()
        {    
            $lists = Group::simplePaginate(10);  
            $addgroupUrl = route('ops.addgroup');                    
            return view('ops.group_list',[
            'lists' => $lists,
            'addgroupUrl' => $addgroupUrl
            ]);  
        }
        
        public function showgroup($id)
        { 
            $group = Group::find($id);
            $showUrl = route('ops.index'); 
            $hosts = $group->hosts;
            $addhostUrl = route('ops.addhosts',[$id,$group->name]);
            return view('ops.show_group',[
            'lists' => $group,
            'hosts' => $hosts,
            'addhostUrl' => $addhostUrl,
            'showUrl' => $showUrl
            ]);          
        }        

        public function addgroup()
        {      
            $postUrl = route('ops.storegroup');
            $csrf_field =  csrf_field(); 
            return View('ops.add_group',[
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field            
            ]);
        }     
               
        public function deletegroup($id)
        {    
            Groups_host::where('group_id',$id)->delete();
            Group::destroy($id);
            return redirect()->route('ops.index'); 
        }        
                              
        public function storegroup(Request $request)
        {    
            $name = $request->input('name'); 
            if(empty($name))
                {
                    exit('Empty');
                }
            $a = Group::where('name',$name)->first();
            if(!empty($a))
                {   
                    exit('Data is exist');
                }                                       
           $group = new Group;
           $group->name = $name;
           $group->save();
           return redirect()->route('ops.index');   
        }  
                 

        public function addhosts($id, $group)
        {    
            $hosts_group = Group::find($id)->hosts()->select('name')->get(); 
            $hosts_list = array();
            foreach ($hosts_group as $i)
            {
                $hosts_list[]=$i->name;
            }          
            //dd($hosts_list);
            $hosts = Host::select('id','name')->whereNotIn('name',$hosts_list)->get();
            $postUrl = route('ops.storehosts', $id);
            $csrf_field =  csrf_field(); 
            //dd($hosts);
            return View('ops.add_hosts',[
            'group_id'=>$id,
            'group' => $group,
            'lists' => $hosts,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field            
            ]);
        }  

        public function storehosts(Request $request, $id)
        {    
            $host_id = $request->input('cb');
            foreach ($host_id as $i)
            {
                $r = new Groups_host;
                $r->group_id = $id;
                $r->host_id = $i;
                $r->save();
            }
            return redirect()->route('ops.showgroup',$id);             
        } 
                
        public function deletehosts($group_id, $host_id)
        {    
            Groups_host::where('group_id',$group_id)->where('host_id',$host_id)->delete();
            return redirect()->route('ops.showgroup',$group_id); 
        } 
                       
        public function backup($id)
        {    
            $postUrl = route('ops.runbackup',$id);
            $csrf_field =  csrf_field(); 
            return View('ops.backup',[
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field,
            'id' =>$id          
            ]); 
        }    
        
        public function runbackup(Request $request,$id)
        {    
            $file = $request->input('file');
            if(empty($file))
            {
                exit('File is Empty');
            } 
            $hosts = Group::find($id)->hosts;
            foreach ($hosts as $i)
            {
                echo "Process:".$i->name."@".$i->ip.":/".$file."</br>";                
            }

        }           
                
        public function install()
        {    
            return 'install';   
        }         
        
        public function release($id)
        {    
            $file_list = File::all();
            $postUrl = route('ops.runrelease',$id);
            $csrf_field =  csrf_field(); 
            return View('ops.release',[
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field,
            'lists' => $file_list,
            'id' =>$id          
            ]); 
        }      
        
        public function runrelease(Request $request,$id)
        {    
            $path = $request->input('path');
            $file = $request->input('file');
            $hosts = Group::find($id)->hosts;
            foreach ($hosts as $i)
            {
                echo "Release ".$file." to ".$i->name."@".$i->ip.":/".$path."</br>";                
            }              
        }    
        
        public function runcommand($command,$id)
        {    
            $hosts = Group::find($id)->hosts;
            $res = array();
            foreach ($hosts as $i)
            {
		          $c = "sudo salt '$i->name' cmd.run '$command'";
                    exec($c, $res, $rc); 
            } 
            $showUrl = route('ops.index');
            return View('ops.commandresults',[
            'lists' => $res,    
            'showUrl' =>$showUrl
            ]); 
        }                 
}
