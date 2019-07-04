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
            if(strcmp($data['login'], $user->login) == 0 && Hash::check($data['password'], $user->password)){
                return response()->json($user);
            }
        }        
        return response()->json('');
    }
}