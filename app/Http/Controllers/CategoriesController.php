<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class CategoriesController extends Controller
{

    public function getAll(){
        //echo var_dump(Category::getAll());

        return response()->json(Category::getAll());
    }

    public function findById($id){
        return response()->json(Category::findById($id));
    }

    public function create(Request $request){
        $type = Type::findById($request['type']['id']);
        $category = new Category();        
    
        $category->setDescription($request['description']);
        $category->setStatus($request['status']);
        $category->setType($type);
        
        try{
            $category->create();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
/*
    public function update(Request $request){
        $category = $this->category::find($request->id);
        $category->description = $request->description;
        try{
            $category->save();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $category = $this->category::find($id);
        try{
            $category->delete($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
    */
}