<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    
    public function types()
    {
         return $this->hasMany('App\Models\Type','id','type_id');
         //return $this->belongsTo('App\Models\TYPE');
    }
    
    public function owners()
    {
         return $this->hasMany('App\Models\Owner','id','owner_id');
    }    
    
    public function groups()
    {
         return $this->belongsToMany('App\Models\Group','groups_hosts','host_id','group_id');

    }

}
