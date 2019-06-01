<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Support\Facades\DB;


class Category extends Model{
    use SoftDeletes;
    protected $fillable = ['id', 'description', 'status', 'updated_at'];
}
