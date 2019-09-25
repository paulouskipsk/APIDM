<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    private $errors;

    protected $fillable = [ 'id', 'name', 'login', 'password','image'];

    public function __construct($id=0, $name='', $login='', $password='', $image='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->image = $image;
    }

    public static function getAll()
    {
        $data = DB::table('users')
                    ->orderBy('name')
                    ->get();
        $users = array();

        if (isset($data)) {
            foreach ($data as $item) {
                $user = new User(
                    $item->id,
                    $item->name,
                    $item->login,
                    $item->password,
                    $item->image
                );
                array_push($users, $user);
            }
        }
        return $users;
    }
    public static function findById($id)
    {
        $item = DB::table('users')
                    ->where('users.id', $id)
                    ->first();
                    
        if (isset($item)) {
            return new User(
                $item->id,
                $item->name,
                $item->login,
                $item->password,
                $item->image
            );
        }
        return new User();
    }
    public function create()
    {
        try {
            $this->validate();
            if (!isset($this->errors)) {
                DB::beginTransaction();
                DB::table('users')->insert([
                    'name'      => $this->name,
                    'login'     => $this->login,
                    'password'  => Hash::make($this->password),
                    'image'     => $this->image
                ]);
                DB::commit();
                return true;
            }
            return $this->errors;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao salvar a Usuario : " + $err));
        }
    }
    public function _update()
    {
        try {
            DB::beginTransaction();
            DB::table('users')
                    ->where('id', $this->id)
                    ->update([
                        'name'      => $this->name,
                        'login'     => $this->login,
                        'password'  => Hash::make($this->password),
                        'image'     => $this->image
                ]);

            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Usuário : "+$err));
        }
    }

    public function drop($id)
    {
        try {
            DB::beginTransaction();
            DB::table('users')
                    ->where('id', $this->id)
                    ->delete();
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Usuário : "+$err));
        }
    }

    private function validate(){
        if(strlen($this->name) < 3){
            $this->errors["name"] = "Nome deve ter mais que 3 Caracteres";
        }
        
        if($this->login < 3){
            $this->errors["login"] = "Login deve ter mais que 3 Caracteres";
        }

        if($this->password < 3){
            $this->errors["password"] = "password deve ter mais que 3 Caracteres";
        }
    }
}
