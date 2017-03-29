<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s';
    public function hosts()
    {
        return $this->belongsTo('App\Models\Host','id','owner_id');
    }   
}
