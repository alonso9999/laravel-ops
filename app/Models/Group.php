<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s';
    public function hosts()
    {
         return $this->belongsToMany('App\Models\Host','groups_hosts','group_id','host_id');

    }
}
