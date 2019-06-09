<?php

namespace App\Http\Controllers;
use App\Models\Type;

use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function getAll(){
        return response()->json(Type::getAll());
    }

    public function findById($id){
        return response()->json(Type::find($id));
    }
}
