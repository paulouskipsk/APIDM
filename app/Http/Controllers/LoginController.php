<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $data = $request->json()->all();
        $users = User::getAll();

        foreach($users as $user){
            if ($user->login == $data['login'] && $user->password == $data['password']) {
                $response = 'ok';
                return response()->json($response);
            }
        }        
        return "Usuário ou senha inválidos";
    }
}