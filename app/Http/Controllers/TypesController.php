<?php

namespace App\Http\Controllers;
use App\Models\Type;

class TypesController extends Controller
{

    public function getAll(){
        return response()->json(Type::getAll());
    }

    public function findById($id){
        return response()->json(Type::findById($id));
    }
    
}
