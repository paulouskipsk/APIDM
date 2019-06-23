<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class Expense extends Model
{
    protected $fillable = [
        'id',
        'description',
        'status',
        'paymentDate',
        'amountPay',
        'additionalCharges',
        'paid',
        'comments',
        'category'
    ];
    public function __construct(
        $id                    = null,
        $description           = null,
        $status                = null,
        $paymentDate           = null,
        $amountPay             = null,
        $additionalCharges     = null,
        $paid                  = null,
        $comments              = null,
        $category              = null
    ) {
        $this->id                    = $id               ;
        $this->description           = $description      ;
        $this->status                = $status           ;
        $this->paymentDate           = $paymentDate      ;
        $this->amountPay             = $amountPay        ;
        $this->additionalCharges     = $additionalCharges;
        $this->paid                  = $paid             ;
        $this->comments              = $comments         ;
        $this->category              = $category         ;
    }

    public static function getAll()
    {
        $data = DB::table('expenses')
            ->orderBy('description')
            ->where('status', '<>', 'D')
            ->get();
        $expenses = array();
        foreach ($data as $item) {
            $expense = new Expense(
                $item->id,
                $item->description,
                $item->status,
                $item->paymentDate,
                $item->amountPay,
                $item->additionalCharges,
                $item->paid,
                $item->comments,
                Category::findById($item->category_id)
            );

            array_push($expenses, $expense);
        }
        return $expenses;
    }

    public static function findById($id)
    {
        $item = DB::table('expenses')
                    ->where('expenses.id', $id)
                    ->first();
                    
        if(isset($item)){
            return new Expense(
                $item->id,
                $item->description,
                $item->status,
                $item->paymentDate,
                $item->amountPay,
                $item->additionalCharges,
                $item->paid,
                $item->comments,
                Category::findById($item->category_id)
            );
        }         
        return new Expense();
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            DB::table('expenses')->insert([
                'description'           => $this->description      ,
                'status'                => $this->status           ,
                'paymentDate'           => $this->paymentDate      ,
                'amountPay'             => $this->amountPay        ,
                'additionalCharges'     => $this->additionalCharges,
                'paid'                  => $this->paid             ,
                'comments'              => $this->comments         ,
                'category_id'           => $this->category->id     ,
            ]);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao salvar a Despesa : "+$err));
        }
    }

    public function _update()
    {
        try {
            DB::beginTransaction();
            DB::table('expenses')
                ->where('id', $this->id)
                ->update([
                    'description'           => $this->description      ,
                    'status'                => $this->status           ,
                    'paymentDate'           => $this->paymentDate      ,
                    'amountPay'             => $this->amountPay        ,
                    'additionalCharges'     => $this->additionalCharges,
                    'paid'                  => $this->paid             ,
                    'comments'              => $this->comments         ,
                    'category_id'           => $this->category->id     ,
                ]);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Despesa : "+$err));
        }
    }

    public function drop($id)
    {
        try {
            DB::beginTransaction();
            DB::table('expenses')
                ->where('id', $this->id)
                ->update(['status' => 'D']);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Deletar a Despesa : "+$err));
        }
    }
}
