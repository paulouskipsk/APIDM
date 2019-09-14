<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revenue;

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
            $data['receivingValue'],
            $data['receivingDate'],
            $data['received']
        );
        return response()->json($revenue->create());
    }

    public function update(Request $request){
        $data = $request->json()->all();
        $revenue = new Revenue(
            $data['id'],
            $data['description'],
            $data['receivingValue'],
            $data['receivingDate'],
            $data['received']
        );
        return response()->json($revenue->_update());
    }

    public function delete($id){
        $revenue = Revenue::findById($id);
        return response()->json($revenue->drop());
    }
}
