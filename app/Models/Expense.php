<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class Expense extends Model
{
    private $errors;
    protected $fillable = [
        'id',
        'description',
        'paymentDate',
        'amountPay',
        'paid'
    ];
    public function __construct(
        $id                    = null,
        $description           = null,
        $paymentDate           = null,
        $amountPay             = null,
        $paid                  = null
    ) {
        $this->id                    = $id               ;
        $this->description           = $description      ;
        $this->paymentDate           = $paymentDate      ;
        $this->amountPay             = $amountPay        ;
        $this->paid                  = $paid             ;
    }

    public static function getAll()
    {
        $data = DB::table('expenses')
            ->orderBy('description')
            ->get();
        $expenses = array();
        foreach ($data as $item) {
            $expense = new Expense(
                $item->id,
                $item->description,
                $item->paymentDate,
                $item->amountPay,
                $item->paid
            );

            array_push($expenses, $expense);
        }
        return $expenses;
    }

    public static function findById($id)
    {
        $item = DB::table('expenses')
                    ->where('id', $id)
                    ->first();
                    
        if(isset($item)){
            return new Expense(
                $item->id,
                $item->description,
                $item->paymentDate,
                $item->amountPay,
                $item->paid
            );
        }         
        return new Expense();
    }

    public function create()
    {
        try {
            $this->validate();
            if(!isset($this->errors)){
                DB::beginTransaction();
                DB::table('expenses')->insert([
                    'description'           => $this->description      ,
                    'paymentDate'           => $this->paymentDate      ,
                    'amountPay'             => $this->amountPay        ,
                    'paid'                  => $this->paid             
                ]);
                DB::commit();
                return '';
            }else{
                return $this->errors;
            }
        } catch (Exception $err) {
            DB::rollback();
            return ["Message"=>"Erro ao salvar Registro: (".$err.")"];
        }
    }

    public function _update()
    {
        try {
            $this->validate();
            if(!isset($this->errors)){
                DB::beginTransaction();
                DB::table('expenses')
                    ->where('id', $this->id)
                    ->update([
                        'description'           => $this->description      ,
                        'paymentDate'           => $this->paymentDate      ,
                        'amountPay'             => $this->amountPay        ,
                        'paid'                  => $this->paid             
                    ]);
                DB::commit();
                return '';
            }else{
                return $this->errors;
            }
        } catch (Exception $err) {
            DB::rollback();
            return ["message"=>"Erro ao Atualizar a Despesa : ".$err];
        }
    }

    public function drop()
    {
        try {
            DB::beginTransaction();
            DB::table('expenses')
                ->where('id', $this->id)
                ->delete();
            DB::commit();
            return '';
        } catch (Exception $err) {
            DB::rollback();
            return ["message"=>"Erro ao Deletar a Despesa : ".$err];
        }
    }

    private function validate(){
        if(strlen($this->description) < 3){
            $this->errors = ["description" => "Descrição deve ter mais que 3 caracteres"];
        }
        
        if($this->amountPay <= 0){
            $this->errors["amountPay"] = "Valor da despeza deve ser maior que zero";
        }
          
        if(!$this->paymentDate == null){
            $date = Array();
            $date = explode('-', $this->paymentDate);

            if(!checkdate($date[1], $date[2], $date[0])){
                $this->errors["paymentDate"] = "Data de Pagamento Inválido";
            }
        }else{
            $this->errors["paymentDate"] = "Data de Pagamento não informado";
        }
    }
}
