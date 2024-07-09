<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
use App\Models\t_entrevista_salida;

use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory; 
use DateTime;
use geoPHP;
class CordenadasController extends Controller
{
    
    public function insertar_cordenadas1011(){return view('Transmasivo.rh.insertar_cordenadas1011'); }

    public function insertar_cordenadas65(){return view('Transmasivo.rh.economicos.insertar_cordenadas65'); }
    public function insertar_cordenadas66(){return view('Transmasivo.rh.economicos.insertar_cordenadas66'); }
    public function insertar_cordenadas67(){return view('Transmasivo.rh.economicos.insertar_cordenadas67'); }
    public function insertar_cordenadas68(){return view('Transmasivo.rh.economicos.insertar_cordenadas68'); }
    public function insertar_cordenadas69(){return view('Transmasivo.rh.economicos.insertar_cordenadas69'); }
    public function insertar_cordenadas70(){return view('Transmasivo.rh.economicos.insertar_cordenadas70'); }
    public function insertar_cordenadas71(){return view('Transmasivo.rh.economicos.insertar_cordenadas71'); }
    public function insertar_cordenadas72(){return view('Transmasivo.rh.economicos.insertar_cordenadas72'); }
    public function insertar_cordenadas73(){return view('Transmasivo.rh.economicos.insertar_cordenadas73'); }
    public function insertar_cordenadas74(){return view('Transmasivo.rh.economicos.insertar_cordenadas74'); }
    

    public function insertar_cordenadas75(){return view('Transmasivo.rh.economicos.insertar_cordenadas75'); }
    public function insertar_cordenadas76(){return view('Transmasivo.rh.economicos.insertar_cordenadas76'); }
    public function insertar_cordenadas77(){return view('Transmasivo.rh.economicos.insertar_cordenadas77'); }
    public function insertar_cordenadas78(){return view('Transmasivo.rh.economicos.insertar_cordenadas78'); }
    public function insertar_cordenadas79(){return view('Transmasivo.rh.economicos.insertar_cordenadas79'); }
    public function insertar_cordenadas80(){return view('Transmasivo.rh.economicos.insertar_cordenadas80'); }
    public function insertar_cordenadas81(){return view('Transmasivo.rh.economicos.insertar_cordenadas81'); }
    public function insertar_cordenadas82(){return view('Transmasivo.rh.economicos.insertar_cordenadas82'); }
    public function insertar_cordenadas83(){return view('Transmasivo.rh.economicos.insertar_cordenadas83'); }
    public function insertar_cordenadas84(){return view('Transmasivo.rh.economicos.insertar_cordenadas84'); }
    

    public function insertar_cordenadas85(){return view('Transmasivo.rh.economicos.insertar_cordenadas85'); }
    public function insertar_cordenadas86(){return view('Transmasivo.rh.economicos.insertar_cordenadas86'); }
    public function insertar_cordenadas87(){return view('Transmasivo.rh.economicos.insertar_cordenadas87'); }
    public function insertar_cordenadas88(){return view('Transmasivo.rh.economicos.insertar_cordenadas88'); }
    public function insertar_cordenadas89(){return view('Transmasivo.rh.economicos.insertar_cordenadas89'); }
    public function insertar_cordenadas90(){return view('Transmasivo.rh.economicos.insertar_cordenadas90'); }
    public function insertar_cordenadas91(){return view('Transmasivo.rh.economicos.insertar_cordenadas91'); }
    public function insertar_cordenadas92(){return view('Transmasivo.rh.economicos.insertar_cordenadas92'); }
    public function insertar_cordenadas93(){return view('Transmasivo.rh.economicos.insertar_cordenadas93'); }
    public function insertar_cordenadas94(){return view('Transmasivo.rh.economicos.insertar_cordenadas94'); }
    

    public function insertar_cordenadas95(){return view('Transmasivo.rh.economicos.insertar_cordenadas95'); }
    public function insertar_cordenadas96(){return view('Transmasivo.rh.economicos.insertar_cordenadas96'); }
    public function insertar_cordenadas97(){return view('Transmasivo.rh.economicos.insertar_cordenadas97'); }
    public function insertar_cordenadas98(){return view('Transmasivo.rh.economicos.insertar_cordenadas98'); }
    public function insertar_cordenadas99(){return view('Transmasivo.rh.economicos.insertar_cordenadas99'); }
    public function insertar_cordenadas1001(){return view('Transmasivo.rh.economicos.insertar_cordenadas1001'); }
    public function insertar_cordenadas1002(){return view('Transmasivo.rh.economicos.insertar_cordenadas1002'); }
    public function insertar_cordenadas1003(){return view('Transmasivo.rh.economicos.insertar_cordenadas1003'); }
    public function insertar_cordenadas1004(){return view('Transmasivo.rh.economicos.insertar_cordenadas1004'); }
    public function insertar_cordenadas1005(){return view('Transmasivo.rh.economicos.insertar_cordenadas1005'); }
    

    public function insertar_cordenadas1006(){return view('Transmasivo.rh.economicos.insertar_cordenadas1006'); }
    public function insertar_cordenadas1007(){return view('Transmasivo.rh.economicos.insertar_cordenadas1007'); }
    public function insertar_cordenadas1008(){return view('Transmasivo.rh.economicos.insertar_cordenadas1008'); }
    public function insertar_cordenadas1009(){return view('Transmasivo.rh.economicos.insertar_cordenadas1009'); }
    public function insertar_cordenadas1010(){return view('Transmasivo.rh.economicos.insertar_cordenadas1010'); }
    public function insertar_cordenadas1012(){return view('Transmasivo.rh.economicos.insertar_cordenadas1012'); }
    public function insertar_cordenadas1(){return view('Transmasivo.rh.economicos.insertar_cordenadas1'); }
    public function insertar_cordenadas15(){return view('Transmasivo.rh.economicos.insertar_cordenadas15'); }
    public function insertar_cordenadas24(){return view('Transmasivo.rh.economicos.insertar_cordenadas24'); }
    public function insertar_cordenadas25(){return view('Transmasivo.rh.economicos.insertar_cordenadas25'); }

    
    public function insertar_cordenadas35(){return view('Transmasivo.rh.economicos.insertar_cordenadas35'); }
    public function insertar_cordenadas41(){return view('Transmasivo.rh.economicos.insertar_cordenadas41'); }
    public function insertar_cordenadas45(){return view('Transmasivo.rh.economicos.insertar_cordenadas45'); }
    public function insertar_cordenadas46(){return view('Transmasivo.rh.economicos.insertar_cordenadas46'); }
    
    public function insertar_cordenadas(Request $request)
    {
        $cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');
        return 'si';
    }
    public function insertar_cordenadas1011_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}

    public function insertar_cordenadas65_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas66_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas67_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas68_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas69_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas70_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas71_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas72_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas73_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas74_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}

    public function insertar_cordenadas75_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas76_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas77_i(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();
            
            $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        if($request->has('Siniestro'))
        {
            $cambios=DB::connection('mysql')->insert('insert into t_reporte_economico_celular 
            values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('lon').'","'.$hora_formateada.'","Siniestro","Activo")');
        }
        if($request->has('Falla'))
        {
            $cambios=DB::connection('mysql')->insert('insert into t_reporte_economico_celular 
            values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('lon').'","'.$hora_formateada.'","Falla","Activo")');
        }
        if($request->has('Manifestación'))
        {
            $cambios=DB::connection('mysql')->insert('insert into t_reporte_economico_celular 
            values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('lon').'","'.$hora_formateada.'","Manifestación","Activo")');
        }
        
    }
    public function insertar_cordenadas78_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas79_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas80_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas81_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas82_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas83_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas84_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}

    public function insertar_cordenadas85_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas86_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas87_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas88_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas89_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas90_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas91_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas92_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas93_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas94_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}

    public function insertar_cordenadas95_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas96_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas97_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas98_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas99_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1001_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1002_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1003_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1004_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1005_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    
    public function insertar_cordenadas1006_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1007_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1008_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1009_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1010_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1012_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas1_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas15_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas24_i(Request $request)
{
    // Establecer la zona horaria a 'America/Mexico_City'
    date_default_timezone_set('America/Mexico_City');
    
    // Insertar los datos en la base de datos con la fecha y hora actuales
    $cambios = DB::connection('mysql')->insert(
        'insert into t_geolocalizacion_eco values (null, ?, ?, ?, ?)', 
        [
            $request->input('eco'), 
            $request->input('lat'), 
            $request->input('log'), 
            now()
        ]
    );

    return 'si';
}

    public function insertar_cordenadas25_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}

    
    public function insertar_cordenadas35_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas41_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas45_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    public function insertar_cordenadas46_i(Request $request)
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
    

    
}
