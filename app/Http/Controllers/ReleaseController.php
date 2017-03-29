<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use DB;

class ReleaseController extends Controller
{
        public function index()
        {    
            $host_list = DB::table('release_hosts')
                ->select('cmdb_hosts.id','cmdb_hosts.hosts','release_hosts.ver','release_hosts.updated_at')
                ->leftJoin('cmdb_hosts','release_hosts.hosts_id','=','cmdb_hosts.id')
                ->simplePaginate(10);
            $backupUrl = route('release.backup');         
            return view('release.hosts_list',[
            'list' => $host_list,
            'backup' => $backupUrl
            ]);                
        }
        
        public function backup()
        {    
            return 'backup';   
        }        
        
        public function store()
        {    
            return 'store';   
        }        
                
        public function release()
        {    
            return 'release';   
        }        
        
        public function checkver()
        {    
            return 'checkver';   
        }        
        
        
        
}
