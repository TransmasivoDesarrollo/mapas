<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
        
            $proyectos=DB::select('SELECT *, cat_proyectos.proyecto as N_proyecto FROM proyectolote inner join cat_proyectos on cat_proyectos.id_proyecto=proyectolote.proyecto 
        where proyectolote.proyecto=25');

            return redirect()->intended('/mapas',compact('proyectos'));
        } else {
            // Autenticación fallida
            return back()->withErrors(['email' => 'Correo electrónico o contraseña incorrectos']);

        }
    }
}
