<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Category;

class ExpensesController extends Controller
{
    public function getAll(){
        return response()->json(Expense::getAll());
    }

    public function findById($id){
        return response()->json(Expense::findById($id));
    }

    public function create(Request $request){
        $data = $request->json()->all();

        $expense = new Expense(
            0,
            $data['description'],
            $data['paymentDate'],
            $data['amountPay'],
            $data['paid']
        );

        try{
            $expense->create();

            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){ // verificar mensagem quando nao da certo
        $data = $request->json()->all();

        $expense = new Expense(
            $data['id'],
            $data['description'],
            $data['paymentDate'],
            $data['amountPay'],
            $data['paid']
        );

        return response()->json($expense->_update());
    }

    public function delete($id){
        $expense = Expense::findById($id);
        return response()->json($expense->drop());
    }
}
