<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'cmdb_list';
    public $primaryKey = 'is';
    protected $dateFormat = 'Y-m-d H:i:s';
}
