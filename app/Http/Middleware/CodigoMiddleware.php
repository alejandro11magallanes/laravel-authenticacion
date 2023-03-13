<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CodigoMiddleware
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
        $codigos = $request->input('codigo');
        $usuario = auth()->user()->id;

        $codigo_en_bd = DB::table('codigos')->where('codigo_dos', $codigos)->value('codigo_dos');
        $usuario_en_bd = DB::table('codigos')->where('user_id', $usuario)->value('user_id');

        
    
            if ($codigo_en_bd == $codigos && $usuario_en_bd == auth()->user()->id) {
                return $next($request);
            }
            else{
                return redirect()->back()->with('error', 'El código ingresado no es válido.');
            }
            
         // Si el código es válido, permite el acceso a la ruta dashboard
       
        // Si el código no es válido, redirige a la página del formulario
        

    }
}
