<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenue;
use App\Models\Category;



class RevenuesController extends Controller
{
    public function getAll(){
        return response()->json(Revenue::getAll());
    }

    public function findById($id){
        return response()->json(Revenue::findById($id));
    }

    public function create(Request $request){
        $data = $request->json()->all();

        $revenue = new Revenue(
            0,
            $data['description'],
            $data['status'],
            $data['receivingValue'],
            $data['receivingDate'],
            $data['received'],
            $data['comments'],
            Category::findById($data['category']['id'])
        );

        try{
            $revenue->create();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $data = $request->json()->all();

        $revenue = new Revenue(
            $data['id'],
            $data['description'],
            $data['status'],
            $data['receivingValue'],
            $data['receivingDate'],
            $data['received'],
            $data['comments'],
            Category::findById($data['category']['id'])
        );

        try{
            $revenue->_update();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $revenue = Revenue::findById($id);
        try{
            $revenue->drop($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}
