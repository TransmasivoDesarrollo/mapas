<?php

namespace App\Http\Controllers\Sistemas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BD;
use App\Models\User;

class SistemasController extends Controller
{
    public function __construct()
	{

		$this->middleware(['auth']);
	}

    public function AltaAccesoAlSistema()
    {
        
        return view('Transmasivo.sistemas.Alta_Acceso_Al_Sistema');
    }
    public function Registro_de_acceso(Request $request)
    {
       
        $Nombre=$request->input('Nombre')." ".$request->input('Apellido_Paterno')." ".$request->input('Apellido_Materno');
        $contraseña=$request->input('contrasena');
        $email=$request->input('email');
        $Rol=$request->input('Rol');

        User::factory()->create([
            'name' => $Nombre,
            'password' => $contraseña,
            'email' => $email,
            'tipo_usuario' => $Rol,
            
        ]);
        $mensaje="Se inserto correctamente!!";
        return view('Transmasivo.sistemas.Alta_Acceso_Al_Sistema',compact('mensaje'));
    }
}
