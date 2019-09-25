<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;
    //protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('guest');
    }

    public function getAll(){
        return response()->json(User::getAll());
    }

    public function findById($id){
        return response()->json(User::findById($id));
    }

    public function create(Request $request){
        $data = $request->json()->all();

        $user = new User(
            0,    
            $data['name'],
            $data['login'],
            $data['password'],
            $data['status'],
            $data['image']
        );

        try{
            $user->create();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function update(Request $request){
        $data = $request->json()->all();

        $user = new User(
            $data['id'],  
            $data['name'],
            $data['login'],
            $data['password'],
            $data['status'],
            $data['image']
        );

        try{
            $user->_update();
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    public function delete($id){
        $user = User::findById($id);
        try{
            $user->drop($id);
            return 1;
        }catch(Exception $e){
            return 0;
        }
    }
}
