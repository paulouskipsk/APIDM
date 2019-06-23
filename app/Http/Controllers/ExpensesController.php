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
            $data['status'],
            $data['paymentDate'],
            $data['amountPay'],
            $data['additionalCharges'],
            $data['paid'],
            $data['comments'],
            Category::findById($data['category']['id'])
        );

        try{
            $expense->create();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $data = $request->json()->all();

        $expense = new Expense(
            $data['id'],
            $data['description'],
            $data['status'],
            $data['paymentDate'],
            $data['amountPay'],
            $data['additionalCharges'],
            $data['paid'],
            $data['comments'],
            Category::findById($data['category']['id'])
        );

        try{
            $expense->_update();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $expense = Expense::findById($id);
        try{
            $expense->drop($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}
