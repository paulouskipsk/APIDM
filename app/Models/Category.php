<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class Category extends Model
{
    protected $fillable = [ 'id', 'description', 'type', 'status' ];

    public function __construct($id=0, $description='', $status='I', $type=[]){
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->type = $type;        
    }
    public static function getAll(){
        $data = DB::table('categories')
                    ->orderBy('description')
                    ->where('status','<>','D')
                    ->get();
        $categories = array();
        foreach($data as $item){
            $category = new Category(
                $item->id,
                $item->description,
                $item->status,                
                Type::findById($item->type_id)
            );
            array_push($categories, $category);
        }
        return $categories;
    }
    public static function findById($id){
        $item = DB::table('categories')
                    ->where('categories.id', $id)
                    ->first();
                    
        if(isset($item)){
            return new Category(
                $item->id,
                $item->description,
                $item->status,                
                Type::findById($item->type_id)
            );
        }         
        return new Category();
    }
    public function create(){
        Try{
            DB::beginTransaction();
                DB::table('categories')->insert([
                    'description'   => $this->description, 
                    'status'        => $this->status,
                    'type_id'       => $this->type->id                  
                ]);
            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao salvar a Categoria : "+$err));
        }
    }
    public function _update(){
        Try{
            DB::beginTransaction();
                DB::table('categories')
                    ->where('id', $this->id)
                    ->update([
                        'description'   => $this->description, 
                        'status'        => $this->status,
                        'type_id'       => $this->type->id
                ]);
            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Categoria : "+$err));
        }
    }

    public function drop($id){
        Try{
            DB::beginTransaction();
                DB::table('categories')
                    ->where('id', $this->id)
                    ->update(['status' => 'D' ]);
            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Categoria : "+$err));
        }
    }  
    
}
