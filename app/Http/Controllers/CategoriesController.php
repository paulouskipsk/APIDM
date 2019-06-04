<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class CategoriesController extends Controller
{
    public function getAll(){
        return response()->json(Category::All());
    }

    public function findById($id){
        return response()->json(Category::find($id));
    }

    public function create(Request $request){
        $category = new Category();
        $category->description = $request->description;
        $category->typ_id = $request->type->id;

        try{
            $category->save();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $category = Category::find($request->id);
        $category->description = $request->description;
        try{
            $category->save();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $category = Category::find($id);
        try{
            $category->delete($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}