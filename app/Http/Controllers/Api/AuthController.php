<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\Funciones;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    use Funciones;

    public function register(Request $request){

        $validateData = $request->validate([
            'name'=>'required|string|max:200',
            'email' =>'required|string|email|max:200|unique:users',
            'password'=>'required|string|min:8',
        ]);

        $user= User::create([
            'name'=>$validateData['name'],
            'email' =>$validateData['email'],
            'password'=>Hash::make($validateData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'acces_token' =>$token,
            'token_type' =>'Bearer',

        ]);

    }

    public function login(Request $request){

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            return response()->json([
                'resp' => false,
                'message' =>'invalid login details'
            ],401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'resp' => true,
            'access_token' =>$token,
            'token_type' =>'Bearer',

        ]);

    }

    function logout(){
        request()->session()->flush();
    }

   public function envioEmail(){

        /*Enviamos Correo*/
        $email=(object)[];
        // $email->email           = 'felixjm@gmail.com';
        $email->email           = 'cmarrerodb@gmail.com';
        $email->destinatario    = "Felix martinez";
        $email->asunto          = "Prueba desde api email";
        $email->cuerpo          = "Prueba desde api";
        $correox = $this->sendemail($email);
        $correox = json_decode($correox);
        if(isset($correox->code)) trigger_error($correox->message);

        return $correox;


   }
}
