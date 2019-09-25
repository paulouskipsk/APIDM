<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class CategoriesController extends Controller
{

    public function getAll(){
        return response()->json(Category::getAll());
    }

    public function findById($id){
        return response()->json(Category::findById($id));
    }

    public function create(Request $request){
        $data = $request->json()->all();

        $type = Type::findById($data['type']['id']);
        $category = new Category(
            0,    
            $data['description'],
            $data['status'],
            $type
        );

        try{
            $category->create();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $data = $request->json()->all();

        $type = Type::findById($data['type']['id']);
        $category = new Category(
            $data['id'],    
            $data['description'],
            $data['status'],
            $type
        );

        try{
            $category->_update();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $category = Category::findById($id);
        try{
            $category->drop($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}