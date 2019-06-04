<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model{
    //use SoftDeletes;
    //protected $fillable = ['id', 'description', 'typ_id', 'updated_at'];
    private $id;
    private $description;
    private $type;
    private $status;

    public function __construct($data = []){
        $this->id = $data->id;
        $this->description = $data->description;
        $this->status = $data->status;
        
        $this->type->id = $data->type->id;
        $this->type->description = $data->type->description;
        $this->type->status = $data->type->status;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDescription(){
        return $this->id;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    // ============================   Funções personalizadas ==============================

    public static function getAll(){
        return DB::select(
            'select * 
                from categories 
                    left join types 
                        on types.id = categories.type_id', $id
        ); 
    }

    public static function findById($id){
        return DB::select(  
            'select * 
                from categories 
                where id = ? 
                left join types 
                        on types.id = categories.type_id', $id);
    }

    public function save(){
        Try{
            DB::beginTransaction();
                DB::insert('insert into categories (description, type_id) values (?, ?)', 
                array($this->description, $this->type->id));
            DB::commit();
            return 1;
        }catch(Exception $err){
            DB::rollback();
            return 0;
        }
    }

    public function update(){
        Try{
            DB::beginTransaction();
                DB::update(
                    "update category set
                        description = ?
                        status = ?
                        type_id = ?
                        where id = ?", 
                        array($this->description, $this->status, $this->type->id, $this->id)
                );
            DB::commit();
            return 1;
        }catch(Exception $err){
            DB::rollback();
            return 0;
        }
    }

    public static function delete($id){
        Try{
            DB::beginTransaction();
                DB::update("update category set status = 'C' where id = ?", $id);
            DB::commit();
            return 1;
        }catch(Exception $err){
            DB::rollback();
            return 0;
        }
    }


    
}
