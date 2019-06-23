<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Revenue;

class ReportsController extends Controller
{
    public function budget($months)
    {
        $budget = array();
        $Revenues = array();
        $Expenses = array();

        $dataRevenue = Revenue::getAll();
        $dataExpense = Expense::getAll();

        foreach ($months as $month) {
            foreach ($dataExpense as $item) {
                if ($item->paymentDate) {
                    array_push($expenses, $item);
                }

            }
        }

    }
}
