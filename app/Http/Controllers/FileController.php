<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use DB;
use App\Models\File;
class FileController extends Controller
{    
        public function __construct(){
            $this->middleware('auth');
        }        
    
        public function index()
        {    
            //$file_list = DB::table('file_list')->simplePaginate(5);
            //$file_list = DB::table('files')->Paginate(10);
            $file_list = File::simplepaginate(10);
            //dd($file_list);
            $uploadUrl = Route('file.upload');
            $csrf_field = csrf_field();   
            $postUrl = route('file.search');
            return view('filev.file_list',[
            'lists' => $file_list, 
            'uploadUrl' => $uploadUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field
            ]);  
    
        }
        
        public function upload()
        {    
            $postUrl = route('file.store');
            $showUrl = route('file.index');
            $csrf_field = csrf_field(); 
            return view('filev.file_create',[
            'showUrl' => $showUrl,
            'postUrl' => $postUrl,
            'csrf_field' =>$csrf_field]);    
              
        }        

        public function store(Request $request)
        {        
            if(!$request->hasFile('file')){
                exit('File is empty');
            }
            $file = $request->file('file');
            //�ж��ļ��ϴ��������Ƿ����
            if(!$file->isValid()){
                exit('Upload error');
            }
                $originalName = $file->getClientOriginalName(); // �ļ�ԭ��
                $ext = $file->getClientOriginalExtension();     // ��չ��
                $realPath = $file->getRealPath();   //��ʱ�ļ��ľ���·��
                $type = $file->getClientMimeType();     // image/jpeg
                // �ϴ��ļ�
                $filename = date('Y-m-d-H-i-s', time()+8*60*60) . '-' . $originalName;
                // ʹ�������½���uploads���ش洢�ռ䣨Ŀ¼��
                $up = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                if($up){
                    //$id = DB::table('file_list')->insertGetId(
                    //    ['filename' => $filename]
                    //)
                        $file = new File;
                        $file->name = $filename;
                        //$file->path = Storage::url($filename);
                        $file->path = '/var/www/laravel/storage/app/public/uploads';
                        $file->save();

                    return redirect()->route('file.index');
                }

            
        } 
        
        public function search(Request $request)
        {
            $file = $request->input('file');
            $showUrl = route('file.index');                      
            //$host_list = DB::table('file_list')
            //    ->where('filename','like','%'.$file.'%')
            //    ->get();     
            $host_list = File::where('name','like','%'.$file.'%')->paginate(10);     
            return view('filev.search_file',[
            'file' => $file,
            'lists' => $host_list,
            'showUrl' => $showUrl      
            ]);
        }     
        
        public function destroy($id)
        {
            File::destroy($id);
            return redirect()->route('file.index');
        }                      
}

