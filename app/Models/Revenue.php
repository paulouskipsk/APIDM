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
                return '';
            }
            return $this->errors;

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
                DB::table('revenues')
                    ->where('id', $this->id)
                    ->update([
                        'description' => $this->description,
                        'receivingValue' => $this->receivingValue,
                        'receivingDate' => $this->receivingDate,
                        'received' => $this->received
                    ]);
                DB::commit();
                return '';
            }else{
                return $this->errors;
            }
        } catch (Exception $err) {
            DB::rollback();
            return ["message"=>"Erro ao alterar Registro: (".$err.")"];
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
            return '';
        } catch (Exception $err) {
            DB::rollback();
            return ["message"=>"Erro ao deletar Registro: (".$err.")"];
        }
    }

    private function validate(){
        if(strlen($this->description) < 3){
            $this->errors["description"] = "Descrição deve ter mais que 3 Caracteres";
        }
        
        if($this->receivingValue <= 0){
            $this->errors["receivingValue"] = "Valor a receber deve ser maior que zero";
        }

        if(!$this->receivingDate == null){
            $date = Array();
            $date = explode('-', $this->receivingDate);

            if(!checkdate($date[1], $date[2], $date[0])){
                $this->errors["receivingDate"] = "Data de Recebimento Inválida";
            }
        }else{
            $this->errors["receivingDate"] = "Data de Recebimento não informada";
        }
    }
}
