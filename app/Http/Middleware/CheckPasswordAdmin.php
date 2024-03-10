<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckPasswordAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {        

        // $login  = session('usuario')
        

        $user2 = User::find($request->user);
        
        if( $request->password && $request->cod =="confirm-reservas2-24" ){
            
            if ($user2->hasRole('SuperUsuario') || $user2->hasRole('Administrador Reservas') ) {    
    
                return $next($request);     
    
            }else{
                return redirect()->route('root')->with('error', 'No se puede otorgar acceso');
            }
        }

        else if( auth()->user()->hasRole('SuperUsuario') ||  auth()->user()->hasRole('Administrador Reservas')){
            
            return $next($request);     
        }

        else{
            return redirect()->route('root')->with('error', 'No se puede otorgar acceso');
        }        

    }
}
