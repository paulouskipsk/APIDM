<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    protected $fillable = [ 'id', 'name', 'login', 'password', 'status', 'image' ];

    public function __construct($id=0, $name='', $login='', $password='', $status='A', $image=''){
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->password = Hash::make($password);
        $this->status = $status;
        $this->image = $image;        
    }
    public static function getAll(){
        $data = DB::table('users')
                    ->orderBy('name')
                    ->where('status','<>','D')
                    ->get();
        $users = array();
        foreach($data as $item){
            $user = new User(
                $item->id,
                $item->name,
                $item->login,
                $item->password,
                $item->status,  
                $item->image              
            );
            array_push($users, $user);
        }
        return $users;
    }
    public static function findById($id){
        $item = DB::table('users')
                    ->where('users.id', $id)
                    ->first();
                    
        if(isset($item)){
            return new User(
                $item->id,
                $item->name,
                $item->login,
                $item->password,
                $item->status,  
                $item->image              
            );
        }         
        return new User();
    }
    public function create(){
        Try{
            DB::beginTransaction();
                DB::table('users')->insert([
                    'name'      => $this->name, 
                    'login'     => $this->login,
                    'password'  => $this->password,
                    'status'    => $this->status,
                    'image'     => $this->image                 
                ]);
            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao salvar a Usuario : "+$err));
        }
    }
    public function _update(){

        Try{
            DB::beginTransaction();
                DB::table('users')
                    ->where('id', $this->id)
                    ->update([
                        'name'      => $this->name, 
                        'login'     => $this->login,
                        'password'  => $this->password,
                        'status'    => $this->status,
                        'image'     => $this->image    
                ]);

            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Usuário : "+$err));
        }
    }

    public function drop($id){
        Try{
            DB::beginTransaction();
                DB::table('users')
                    ->where('id', $this->id)
                    ->update(['status' => 'D' ]);
            DB::commit();
            return true;
        }catch(Exception $err){
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Usuário : "+$err));
        }
    }  
    
}
