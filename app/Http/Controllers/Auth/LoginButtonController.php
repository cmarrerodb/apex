<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginButtonController extends Controller
{
    //

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $login_type = filter_var(request()->input('email'), FILTER_VALIDATE_EMAIL)?'email':'username';

        if(!Auth::attempt([ $login_type => $request->email, 'password' => $request->password])){

            return redirect()->back()->with('resultado_mensaje', 'Las credenciales no existen en nuestros registros');

            // return response()->json([
            //     'resp' => false,
            //     'message' =>'Las credenciales no existen en nuestros registros '
            // ],401);
        }

        // return redirect()->intended();

        switch ($request->modo) {
            case "calendario":
                return redirect()->route('calendario');
                // return redirect()->intended('/calendario/calendario');
                break;
            case "reservar":
                return redirect()->route('reservar');
                // return redirect()->intended('/reservar/reservar');

                break;
            case "administrar":
                return redirect()->route('administrar');
                break;
            case "giftcard":
                return redirect()->route('giftcard');
                break;

            default:
                echo "Opción no válida";
        }

    }
}
