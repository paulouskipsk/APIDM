<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;

class ReportsController extends Controller
{
    public function budget($monthIni, $mountFin)
    {
        $budget = array(
            "revenuesVlrTotal" => 0,
            "expensesVlrTotal" => 0,
            "balance" => 0
        );

        $revenues = 0;
        $expenses = 0;
        $dataRevenue = Revenue::getAll();
        $dataExpense = Expense::getAll();

        

        foreach ($dataExpense as $item) {
            if ($item->paymentDate >=  $monthIni && $item->paymentDate <= $mountFin) {
                $expenses += $item->amountPay + $item->additionalCharges;
            } 
        }    
        $budget['expensesVlrTotal'] = $expenses;

        foreach ($dataRevenue as $item) {
            if ($item->receivingDate >=  $monthIni && $item->receivingDate <= $mountFin) {
                $revenues += $item->receivingValue;
            }   
        }
        $budget['revenuesVlrTotal'] = $revenues;
        $budget['balance'] = $revenues - $expenses;

        return response()->json($budget);
    }
}
