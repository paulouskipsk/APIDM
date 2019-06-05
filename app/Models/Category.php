<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

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
        $data = DB::table('categories')->get();

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
        return DB::table('categories')
                    ->leftJoin('types', 'types.id', '=', 'categories.type_id')
                    ->where('categories.id', $id)
                    ->first();
    }
    public function create(){
        Try{
            DB::beginTransaction();
                DB::table('categories')->insert([
                    'description'   => $this->description, 
                    'status'        => $this->status,
                    'type_id'       => $this->type->getId()                   
                ]);
            DB::commit();
            return 1;
        }catch(Exception $err){
            DB::rollback();
            return 0;
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
                    'type_id'       => $this->type->getId() 
                ]);
            DB::commit();
            return 1;
        }catch(Exception $err){
            DB::rollback();
            return 0;
        }
    }

    public function drop($id){
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
