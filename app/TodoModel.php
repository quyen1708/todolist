<?php

namespace App;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class TodoModel extends Model
{
    protected $primaryKey = 'ID';
    protected $table = "todos";
    protected $fillable = ['ID', 'title','desc', 'completed', 'displayorder'];
}


