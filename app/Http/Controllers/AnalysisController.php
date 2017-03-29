<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Auth;
use App\Models\Data;
use App\jobs\DataAnalysis;
use App\Models\User;
use App\Models\Job;
class AnalysisController extends Controller
{
        public function __construct(){
            $this->middleware('auth');
        }
        
        public function index()
        {    
            $lists = Data::leftJoin('users','data.user_id','=','users.id')
            ->select('users.name as username','users.email as email','file','results')
            ->orderBy('data.id')
            ->simplePaginate(10);  
            $jobs = Job::all();
            $uploadUrl = route('analysis.upload');               
            return view('analysis.show_list',[
            'lists' => $lists,
            'jobs' => $jobs,
            'uploadUrl' => $uploadUrl
            ]);  
        }
        
        public function upload()
        {    
            $postUrl = route('analysis.store');
            $showUrl = route('analysis.index');
            $csrf_field = csrf_field(); 
            return view('filev.file_create',[
            'showUrl' => $showUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field]);    
              
        }        

        public function store(Request $request)
        {        
            $user_id = Auth::user()->id;
            if(!$request->hasFile('file')){
                exit('File is empty');
            }
            $file = $request->file('file');
            //判断文件上传过程中是否出错
            if(!$file->isValid()){
                exit('Upload error');
            }
                $originalName = $file->getClientOriginalName(); // 文件原名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $filename = date('Y-m-d-H-i-s', time()+8*60*60) . '-' . $originalName;
                $up = Storage::disk('analysis')->put($filename, file_get_contents($realPath));
                if($up){             
                    dispatch(new DataAnalysis($filename,$user_id));
                    return redirect()->route('analysis.index');
                }

            
        }         
}
