<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Hamcrest\Core\HasToString;

class Type
{
    protected $fillable = [ 'id', 'description', 'status' ];

    public function __construct($id=0, $description='', $status=''){
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
    }

    public static function getAll(){
        return DB::select( 'select * from types'); 
    }

    public static function findById($id){
        $data = DB::table('types')->where('id', '=', $id)->first();

        $type = new Type(
            $data->id,
            $data->description,
            $data->status
        );

        return $type;
    }
}
