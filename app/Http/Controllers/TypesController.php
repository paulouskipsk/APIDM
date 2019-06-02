<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function getAll(){
        return response()->json(Type::All());
    }

    public function findById($id){
        return response()->json(Type::find($id));
    }

    public function create(Request $request){
        $type = new Type();
        $type->description = $request->description;
        $type->status = $request->status;

        response()->json($request);
        try{
            $type->save();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $type = Type::find($request->id);
        $type->description = $request->description;
        try{
            $type->save();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $type = Type::find($id);
        try{
            $type->delete($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}
