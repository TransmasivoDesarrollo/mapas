<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function mapas()
    {
        $proyectos=DB::select('SELECT *, cat_proyectos.proyecto as N_proyecto FROM proyectolote inner join cat_proyectos on cat_proyectos.id_proyecto=proyectolote.proyecto 
        where proyectolote.proyecto=25');
        $situaciones=DB::select('SELECT * from cat_situacion');

        return view('welcome',compact('proyectos','situaciones'));
    }
    public function Usuarios()
    {
        
        if( Auth::user()->tipo_usuario == 1){
        $users=DB::select('SELECT *from users');
       // dd($users);
        return view('gestionUsuarios',compact('users'));
    }
        
        return redirect('/dashboard');
    }
    public function dashboard()
    {
        return redirect('/');
    }
    public function login()
    {
        
        return redirect('/');
    }
    public function Update_usuarios(Request $request)
    {
        if(isset($request['elimina']))
        {
            
            $elimina = User::where('id', $request['id_user'])->first();
            if ($elimina) {
                $elimina->delete();
              
            }
            
        
            return redirect('/Usuarios')->with(['message' => 'Se elimino correctamente', 'color' => 'success']);

        }else{

       $validator = Validator::make($request->all(), [
                 
              ]);
       
              if ($validator->fails()) {
                  return redirect('/Usuarios')->withErrors($validator)->withInput();
              }else{

               

                $actualizar = User::where('id', $request['id'])->first();

                if($request['password']!=null){
                    $password=bcrypt($request['password']);
                }else{
                    $password=$actualizar->password;
                }
                 
                  $actualizar->update([
                                  'email'=>$request['email'],
                                  'name'=>$request['name'],
                                  'tipo_usuario'=>$request['tipo_u'],
                                  'password'=>$password
                                 ]);

                 
                  return redirect('/Usuarios')->with(['message' => 'Actualización correcta', 'color' => 'success']);



              }
            }

    }
}
