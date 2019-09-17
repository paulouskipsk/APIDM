<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class Revenue extends Model
{
    private $errors;

    protected $fillable = [
        'id',
        'description',
        'receivingValue',
        'receivingDate',
        'received'
    ];
    public function __construct(
        $id = null,
        $description = null,
        $receivingValue = null,
        $receivingDate = null,
        $received = null
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->receivingValue = $receivingValue;
        $this->receivingDate = $receivingDate;
        $this->received = $received;
    }

    public static function getAll(){
        $data = DB::table('revenues')
            ->orderBy('description')
            ->get();
        $revenues = array();
        foreach ($data as $item) {
            $revenue = new Revenue(
                $item->id,
                $item->description,
                $item->receivingValue,
                $item->receivingDate,
                $item->received
            );

            array_push($revenues, $revenue);
        }
        return $revenues;
    }

    public static function findById($id){
        $item = DB::table('revenues')
                    ->where('revenues.id', $id)
                    ->first();
                    
        if(isset($item)){
            return new Revenue(
                $item->id,
                $item->description,
                $item->receivingValue,
                $item->receivingDate,
                $item->received
            );
        }         
        return new Revenue();
    }

    public function create() {
        try {
            $this->validate();
            if(!isset($this->errors)){
                DB::beginTransaction();
                DB::table('revenues')->insert([
                    'description' => $this->description,
                    'receivingValue' => $this->receivingValue,
                    'receivingDate' => $this->receivingDate,
                    'received' => $this->received
                ]);
                DB::commit();
                return ["Message"=>"Registro Salvo com sucesso."];
            }
            return $this->errors;

        } catch (Exception $err) {
            DB::rollback();
            $message = ["Message"=>"Erro ao salvar Registro: (".$err.")"];
            return $message;
        }
    }

    public function _update()
    {
        try {
            $this->validate();
            if(!isset($this->errors)){
                DB::beginTransaction();
                DB::table('revenues')
                    ->where('id', $this->id)
                    ->update([
                        'description' => $this->description,
                        'receivingValue' => $this->receivingValue,
                        'receivingDate' => $this->receivingDate,
                        'received' => $this->received
                    ]);
                DB::commit();
                $message = ["Message"=>"Registro Alterado com sucesso."];
            }else{
                $message = $this->errors;
            }
            return $message;
        } catch (Exception $err) {
            DB::rollback();
            $message = ["message"=>"Erro ao alterar Registro: (".$err.")"];
            return $message;
        }
        
    }

    public function drop()
    {
        try {
            DB::beginTransaction();
            DB::table('revenues')
                ->where('id', $this->id)
                ->delete();
            DB::commit();
            $message = ["message"=>"Registro Deletado com sucesso." ];
            return $message;
        } catch (Exception $err) {
            DB::rollback();
            $message = ["message"=>"Erro ao deletar Registro: (".$err.")"];
            return $message;
        }
    }

    private function validate(){
        if(strlen($this->description) < 3){
            $this->errors["description"] = "Descrição deve ter mais que 3 letras";
        }
        
        if($this->receivingValue <= 0){
            $this->errors["receivingValue"] = "Valor a receber deve ser maior que zero";
        }

        $data = Array();
        $date = explode('-', $this->receivingDate);
        if($this->receivingDate === null || !checkdate($date[2], $date[1], $date[0])){
            $this->errors["receivingDate"] = "Data de Recebimento Inválida";
        }

    }
}
