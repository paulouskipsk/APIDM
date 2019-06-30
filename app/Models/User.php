<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [ 'id', 'name', 'login', 'password', 'status', 'image', 'api_token'];
    protected $hiden = [ 'password', 'remember_token' ];

    public function __construct($id=0, $name='', $login='', $password='', $status='A', $image='', $api_token=''){
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->status = $status;
        $this->image = $image;   
        $this->api_token = $api_token;    
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
                $item->image,
                $item->api_token              
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
                $item->image,
                $item->api_token             
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
                    'password'  => Hash::make($this->password),
                    'status'    => $this->status,
                    'image'     => $this->image,   
                    'api_token' => Str::random(60)            
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
