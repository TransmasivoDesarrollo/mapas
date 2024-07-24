<?php

namespace App\Http\Controllers\Recursos_Humanos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
use App\Models\t_entrevista_salida;
use App\Imports\importarBiometrico;

use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory; 
use DateTime;
use geoPHP;

use Carbon\Carbon;

class RecursosHumanosControlador extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth']);
	}
    public function checkLocation(Request $request)
    {
        $lat = $request->input('latitude');
        $lon = $request->input('longitude');
        $polygon = [
            [-99.01161661797045, 19.61788033321528],
            [-99.00943866431281, 19.619103161356616],
            [-99.00789371196451, 19.617243650417787],
            [-99.01074758227455, 19.616455372984262],
            [-99.01161661797045, 19.61788033321528]
        ];

        if ($this->pointInPolygon($lat, $lon, $polygon)) {
            return response()->json(['status' => 'inside']);
        } else {
            return response()->json(['status' => 'outside']);
        }
    }

    private function pointInPolygon($lat, $lon, $polygon)
    {
        $point = [$lon, $lat];
        $inside = false;
        for ($i = 0, $j = count($polygon) - 1; $i < count($polygon); $j = $i++) {
            if ((($polygon[$i][1] > $point[1]) != ($polygon[$j][1] > $point[1])) &&
                ($point[0] < ($polygon[$j][0] - $polygon[$i][0]) * ($point[1] - $polygon[$i][1]) / ($polygon[$j][1] - $polygon[$i][1]) + $polygon[$i][0])) {
                $inside = !$inside;
            }
        }
        return $inside;
    }

    public function Alta_de_personal()
    {
        return view('Transmasivo.rh.alta_de_personal');
    }
    public function geo()
    {
        $eco_1000 = DB::connection('mysql')
        ->table('t_geolocalizacion_eco')
        ->where('economico', '=', 1000)
        ->latest('id_geolocalizacion')
        ->first();
    
        $secciones = DB::connection('mysql')
        ->table('t_secciones-geolocalizacion')
        ->get();
        return view('Transmasivo.rh.geo',compact('eco_1000','secciones'));
        
    }
    public function geo2()
    {
        return view('Transmasivo.rh.geo2');
    }
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
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
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
    {$cambios=DB::connection('mysql')->insert('insert into t_geolocalizacion_eco values(null,"'.$request->input('eco').'","'.$request->input('lat').'","'.$request->input('log').'","'.now().'")');return 'si';}
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
    

    
    public function geo_ecotodos() {
        $economicos = [
            65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99,
            1000, 1001, 1002, 1003, 1004, 1005, 1006, 1007, 1008, 1009, 1010, 1011, 1012,
            1, 15, 24, 25, 35, 41, 45, 46
        ];
        
        $results = [];
        
        foreach ($economicos as $economico) {
            $result = DB::connection('mysql')->select('SELECT * FROM t_geolocalizacion_eco WHERE economico = ? ORDER BY id_geolocalizacion DESC LIMIT 1', [$economico]);
            $results[$economico] = $result;
        }
        
        return $results;
    }

    public function geo3() {
        $secciones = DB::connection('mysql')
        ->table('t_secciones-geolocalizacion')
        ->get();
       return view('Transmasivo.rh.geo3',compact('secciones'));
    }


    public function geo_eco65(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 65)->latest('id_geolocalizacion')->first();}
    public function geo_eco66(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 66)->latest('id_geolocalizacion')->first();}
    public function geo_eco67(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 67)->latest('id_geolocalizacion')->first();}
    public function geo_eco68(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 68)->latest('id_geolocalizacion')->first();}
    public function geo_eco69(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 69)->latest('id_geolocalizacion')->first();}
    public function geo_eco70(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 70)->latest('id_geolocalizacion')->first();}
    public function geo_eco71(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 71)->latest('id_geolocalizacion')->first();}
    public function geo_eco72(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 72)->latest('id_geolocalizacion')->first();}
    public function geo_eco73(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 73)->latest('id_geolocalizacion')->first();}
    public function geo_eco74(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 74)->latest('id_geolocalizacion')->first();}
    public function geo_eco75(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 75)->latest('id_geolocalizacion')->first();}
    public function geo_eco76(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 76)->latest('id_geolocalizacion')->first();}
    public function geo_eco77(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 77)->latest('id_geolocalizacion')->first();}
    public function geo_eco78(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 78)->latest('id_geolocalizacion')->first();}
    public function geo_eco79(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 79)->latest('id_geolocalizacion')->first();}
    public function geo_eco80(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 80)->latest('id_geolocalizacion')->first();}
    public function geo_eco81(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 81)->latest('id_geolocalizacion')->first();}
    public function geo_eco82(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 82)->latest('id_geolocalizacion')->first();}
    public function geo_eco83(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 83)->latest('id_geolocalizacion')->first();}
    public function geo_eco84(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 84)->latest('id_geolocalizacion')->first();}
    public function geo_eco85(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 85)->latest('id_geolocalizacion')->first();}
    public function geo_eco86(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 86)->latest('id_geolocalizacion')->first();}
    public function geo_eco87(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 87)->latest('id_geolocalizacion')->first();}
    public function geo_eco88(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 88)->latest('id_geolocalizacion')->first();}
    public function geo_eco89(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 89)->latest('id_geolocalizacion')->first();}
    public function geo_eco90(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 90)->latest('id_geolocalizacion')->first();}
    public function geo_eco91(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 91)->latest('id_geolocalizacion')->first();}
    public function geo_eco92(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 92)->latest('id_geolocalizacion')->first();}
    public function geo_eco93(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 93)->latest('id_geolocalizacion')->first();}
    public function geo_eco94(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 94)->latest('id_geolocalizacion')->first();}
    public function geo_eco95(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 95)->latest('id_geolocalizacion')->first();}
    public function geo_eco96(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 96)->latest('id_geolocalizacion')->first();}
    public function geo_eco97(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 97)->latest('id_geolocalizacion')->first();}
    public function geo_eco98(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 98)->latest('id_geolocalizacion')->first();}
    public function geo_eco99(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 99)->latest('id_geolocalizacion')->first();}
    public function geo_eco1000(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1000)->latest('id_geolocalizacion')->first();}
    public function geo_eco1001(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1001)->latest('id_geolocalizacion')->first();}
    public function geo_eco1002(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1002)->latest('id_geolocalizacion')->first();}
    public function geo_eco1003(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1003)->latest('id_geolocalizacion')->first();}
    public function geo_eco1004(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1004)->latest('id_geolocalizacion')->first();}
    public function geo_eco1005(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1005)->latest('id_geolocalizacion')->first();}
    public function geo_eco1006(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1006)->latest('id_geolocalizacion')->first();}
    public function geo_eco1007(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1007)->latest('id_geolocalizacion')->first();}
    public function geo_eco1008(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1008)->latest('id_geolocalizacion')->first();}
    public function geo_eco1009(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1009)->latest('id_geolocalizacion')->first();}
    public function geo_eco1010(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1010)->latest('id_geolocalizacion')->first();}
    public function geo_eco1011(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1011)->latest('id_geolocalizacion')->first();}
    public function geo_eco1012(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1012)->latest('id_geolocalizacion')->first();}
    public function geo_eco1(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 1)->latest('id_geolocalizacion')->first();}
    public function geo_eco15(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 15)->latest('id_geolocalizacion')->first();}
    public function geo_eco24(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 24)->latest('id_geolocalizacion')->first();}
    public function geo_eco25(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 25)->latest('id_geolocalizacion')->first();}
    public function geo_eco35(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 35)->latest('id_geolocalizacion')->first();}
    public function geo_eco41(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 41)->latest('id_geolocalizacion')->first();}
    public function geo_eco45(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 45)->latest('id_geolocalizacion')->first();}
    public function geo_eco46(){return DB::connection('mysql')->table('t_geolocalizacion_eco')->where('economico', '=', 46)->latest('id_geolocalizacion')->first();}




    
    public function Contratos()
    {
        return view('Transmasivo.rh.Contratos');
    }
    public function Renuncias()
    {
        $c_empresas = DB::connection('mysql')->table('c_empresa')->get();
        return view('Transmasivo.rh.Renuncias',compact('c_empresas'));
    }

    public function Encuesta_de_renuncia()
    {
        return view('Transmasivo.rh.Encuesta_de_renuncia');
    }
    public function estadisticas_renuncias()
    {
        $pregu3 = DB::connection('mysql')->select('SELECT relacion_jefe, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY relacion_jefe;');
        $pregu4 = DB::connection('mysql')->select('SELECT reconocimiento_jefe, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reconocimiento_jefe;');
        $pregu5 = DB::connection('mysql')->select('SELECT reconocimiento_empresa, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reconocimiento_empresa;');
        $pregu6 = DB::connection('mysql')->select('SELECT toma_decisiones, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY toma_decisiones;');
        $pregu7 = DB::connection('mysql')->select('SELECT importante_labor, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY importante_labor;');
        $pregu8 = DB::connection('mysql')->select('SELECT sueldo_parecio, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY sueldo_parecio;');
        $pregu9 = DB::connection('mysql')->select('SELECT crecimiento_laboral, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY crecimiento_laboral;');
        $pregu10 = DB::connection('mysql')->select('SELECT instrucciones_claras, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY instrucciones_claras;');
        $pregu11 = DB::connection('mysql')->select('SELECT carga_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY carga_trabajo;');
        $pregu12 = DB::connection('mysql')->select('SELECT reuniones_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY reuniones_trabajo;');
        $pregu13 = DB::connection('mysql')->select('SELECT aspiraciones_empresa, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY aspiraciones_empresa;');
        $pregu14 = DB::connection('mysql')->select('SELECT relaciones_personales_compañeros, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY relaciones_personales_compañeros;');
        $pregu15 = DB::connection('mysql')->select('SELECT responsabilidades_asumir, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY responsabilidades_asumir;');
        $pregu16 = DB::connection('mysql')->select('SELECT satisfecho_trabajo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY satisfecho_trabajo;');
        $pregu17 = DB::connection('mysql')->select('SELECT cansado_falta_energia, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY cansado_falta_energia;');
        $pregu18 = DB::connection('mysql')->select('SELECT entusiasmo_perdido, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY entusiasmo_perdido;');
        $pregu19 = DB::connection('mysql')->select('SELECT perdida_apetito, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY perdida_apetito;');
        $pregu20 = DB::connection('mysql')->select('SELECT irritado, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY irritado;');
        $pregu21 = DB::connection('mysql')->select('SELECT faltas_al_mes, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY faltas_al_mes;');
        $pregu22 = DB::connection('mysql')->select('SELECT cursos_funciionales, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY cursos_funciionales;');
        $pregu23 = DB::connection('mysql')->select('SELECT baja_es, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY baja_es;');
        $pregu24 = DB::connection('mysql')->select('SELECT baja_motivo, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY baja_motivo;');
        $pregu25 = DB::connection('mysql')->select('SELECT volver_laborar, COUNT(*) AS cantidad
        FROM t_entrevista_salida
        GROUP BY volver_laborar;');
        
        return view('Transmasivo.rh.estadisticas_renuncias',
            compact(
                'pregu3',
                'pregu4',
                'pregu5',
                'pregu6',
                'pregu7',
                'pregu8',
                'pregu9',
                'pregu10',
                'pregu11',
                'pregu12',
                'pregu13',
                'pregu14',
                'pregu15',
                'pregu16',
                'pregu17',
                'pregu18',
                'pregu19',
                'pregu20',
                'pregu21',
                'pregu22',
                'pregu23',
                'pregu24',
                'pregu25',
                ));
    }
    public function Encuesta_de_renuncia_guardar(Request $request)
    {
        
        $tiempo_años=$request->input('tiempo_año');
        $tiempo_años= $tiempo_años * 12;
        $tiempo_meses=$request->input('tiempo_meses');
        $tiempo_meses=$tiempo_meses + $tiempo_años;
        $personal = new t_entrevista_salida();
        $personal->id_entrevista_salida= $request->input('id_entrevista_salida');
        $personal->tiempo_laborado_meses= $tiempo_meses;
        $personal->horas_al_dia= $request->input('inicio');
        $personal->relacion_jefe= $request->input('relacion');
        $personal->reconocimiento_jefe= $request->input('reconocimiento_jefe');
        $personal->reconocimiento_empresa= $request->input('reconocimiento_empresa');
        $personal->toma_decisiones= $request->input('decisiones');
        $personal->importante_labor= $request->input('labor_desempeña');
        $personal->sueldo_parecio= $request->input('sueldo_parecio');
        $personal->crecimiento_laboral= $request->input('crecimiento_laboral');
        $personal->instrucciones_claras= $request->input('instrucciones_claras');
        $personal->carga_trabajo= $request->input('carga_trabajo');
        $personal->reuniones_trabajo= $request->input('juntas_reuniones');
        $personal->aspiraciones_empresa= $request->input('aspiraciones_personales');
        $personal->relaciones_personales_compañeros= $request->input('relaciones_personales');
        $personal->responsabilidades_asumir= $request->input('responsabilidad_asumir');
        $personal->satisfecho_trabajo= $request->input('terminar_dia');
        $personal->cansado_falta_energia= $request->input('cansado');
        $personal->entusiasmo_perdido= $request->input('entusiasmo');
        $personal->perdida_apetito= $request->input('apetito');
        $personal->irritado= $request->input('irritado');
        $personal->faltas_al_mes= $request->input('faltas_mes');
        $personal->cursos_funciionales= $request->input('capacitacion_funcionales');
        $personal->baja_es= $request->input('baja_es_por');
        $personal->baja_motivo= $request->input('motivo_renuncia');
        $personal->volver_laborar= $request->input('volverias_laborar');
        $personal->observaciones= $request->input('Observaciones');
        $personal->fecha= now();
        $personal->edad= $request->input('Edad');
        $personal->sexo= $request->input('Sexo');
        $personal->save();

        
        $mensaje="Gracias por concluir la encuesta!";
        $color="success";
       
       return redirect()->route('Encuesta_de_renuncia')->with('mensaje', $mensaje)->with('color', $color);
    }
    
    private function formatearFecha(DateTime $fecha)
    {
        $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    
        $diaSemana = $dias[$fecha->format('w')];
        $dia = $fecha->format('d');
        $mes = $meses[$fecha->format('n') - 1];
        $anio = $fecha->format('Y');
    
        return "$diaSemana $dia de $mes del $anio";
    }
    
    
    public function generarContratos(Request $request)
    {
        $id_operador = auth()->id();
        $user = auth()->user();
        $data = [
            'user' => $user,
            'nombre' => $request->input('nombre'),
            'Edad' => $request->input('Edad'),
            'Fecha_nacimiento' => $request->input('nacimiento'),
            'Sexo' => $request->input('Sexo'),
            'Civil' => $request->input('Civil'),
            'Calle' => $request->input('Calle'),
            'Numero' => $request->input('Numero'),
            'Colonia' => $request->input('Colonia'),
            'Alcaldia' => $request->input('Alcaldia'),
            'Estado' => $request->input('Estado'),
            'postal' => $request->input('postal'),
            'RFC' => $request->input('RFC'),
            'IMSS' => $request->input('IMSS'),
            'CURP' => $request->input('CURP'),
            'Correo' => $request->input('Correo'),
            'Puesto' => $request->input('Puesto'),
            'Nacionalidad' => $request->input('Nacionalidad'),
            'Salario_diario' => $request->input('Salario_diario'),
            'Salario_diario_letras' => $request->input('Salario_diario_letras'),
            'fecha_contrato' => $request->input('fecha_contrato_hidden'),
        ];
        $personal = new TPersonal();

        $personal->Nombre= $request->input('nombre');
        $personal->Edad= $request->input('Edad');
        $personal->Fecha_nacimiento= $request->input('nacimiento');
        $personal->Nacionalidad= $request->input('Nacionalidad');
        $personal->Sexo= $request->input('Sexo');
        $personal->Estado_civil= $request->input('Civil');
        $personal->Calle= $request->input('Calle');
        $personal->Numero= $request->input('Numero');
        $personal->Colonia= $request->input('Colonia');
        $personal->Alcaldia_municipio= $request->input('Alcaldia');
        $personal->Estado= $request->input('Estado');
        $personal->Codigo_postal= $request->input('postal');
        $personal->RFC= $request->input('RFC');
        $personal->NSS= $request->input('IMSS');
        $personal->CURP= $request->input('CURP');
        $personal->Correo= $request->input('Correo');
        $personal->Puesto= $request->input('Puesto');
        $personal->Salario_diario= $request->input('Salario_diario');
        $personal->Fecha_contrato= $request->input('fecha_contrato_hidden');
        $personal->Fecha_contrato_date= $request->input('fecha_contrato');
        $personal->Estatus= 'Activo';
        $personal->Fecha_real= now();
        $personal->id_operador = $id_operador;

        
        $personal->save();
    
        // Renderizar la vista a HTML
        $html = View::make('Transmasivo.rh.contratoWord', $data)->render();
    
        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
    
        // Configurar el tamaño de la página a carta (8.5 x 11 pulgadas)
        $section = $phpWord->addSection([
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
        ]);
    
        // Agregar el HTML al documento de Word
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
    
        // Guardar el documento
        $filename = 'Contrato '.$request->input('nombre').'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path($filename));
    
        // Descargar el documento
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }

    public function Personal()
{
    // Fetch the message and color from the session
    $mensaje = session('mensaje');
    $color = session('color');
    
    // Your database query
    $consulta = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal left join users on t_personal.id_operador=users.id');
    
    // Pass variables to the view
    return view('Transmasivo.rh.Personal', compact('consulta', 'mensaje', 'color'));
}

    public function numberToWords($num)
        {
            $units = ["", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve"];
            $teens = ["Diez", "Once", "Doce", "Trece", "Catorce", "Quince", "Dieciséis", "Diecisiete", "Dieciocho", "Diecinueve"];
            $tens = ["", "", "Veinte", "Treinta", "Cuarenta", "Cincuenta", "Sesenta", "Setenta", "Ochenta", "Noventa"];
            $hundreds = ["", "Cien", "Doscientos", "Trescientos", "Cuatrocientos", "Quinientos", "Seiscientos", "Setecientos", "Ochocientos", "Novecientos"];

            if ($num == 0) return "Cero";

            $words = '';

            if ($num >= 1000) {
                $words .= "Mil ";
                $num %= 1000;
            }

            if ($num >= 100) {
                $words .= $hundreds[floor($num / 100)] . " ";
                $num %= 100;
            }

            if ($num >= 20) {
                $words .= $tens[floor($num / 10)] . " ";
                $num %= 10;
            } else if ($num >= 10) {
                $words .= $teens[$num - 10] . " ";
                $num = 0;
            }

            if ($num > 0) {
                $words .= $units[$num] . " ";
            }

            return strtoupper(trim($words));
        }
    public function accionParaPersonal(Request $request)
    {
        if($request->has('baja')){
            DB::connection('mysql')->table('t_personal')
            ->where('id_personal', $request->input('id_personal'))
            ->update(['estatus' => 'Baja']);
            $mensaje="El usuario se dio de baja con exito!";
            $color="success";
           
           return redirect()->route('Personal')->with('mensaje', $mensaje)->with('color', $color);
        }
        if($request->has('Reimprimir')){
            
            $personal = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal inner join users on users.id=t_personal.id_operador where t_personal.id_personal='.$request->input('id_personal'));
            
            $id_operador = auth()->id();
            $user = auth()->user();
            $data = [
                'user' => $user,
                'nombre' =>$personal[0]->Nombre,
                'Edad' => $personal[0]->Edad ,
                'Fecha_nacimiento' =>$personal[0]->Fecha_nacimiento ,
                'Sexo' =>$personal[0]->Sexo ,
                'Civil' =>$personal[0]->Estado_civil ,
                'Calle' =>$personal[0]->Calle ,
                'Numero' =>$personal[0]->Numero ,
                'Colonia' =>$personal[0]->Colonia ,
                'Alcaldia' =>$personal[0]->Alcaldia_municipio ,
                'Estado' =>$personal[0]->Estado ,
                'postal' =>$personal[0]->Codigo_postal ,
                'RFC' =>$personal[0]->RFC ,
                'IMSS' =>$personal[0]->NSS ,
                'CURP' =>$personal[0]->CURP ,
                'Correo' =>$personal[0]->Correo ,
                'Puesto' =>$personal[0]->Puesto ,
                'Nacionalidad' =>$personal[0]->Nacionalidad ,
                'Salario_diario' =>$personal[0]->Salario_diario ,
                'Salario_diario_letras' => $this->numberToWords($personal[0]->Salario_diario) ,
                'fecha_contrato' =>$personal[0]->Fecha_contrato ,
            ];

            //dd($this->numberToWords($personal[0]->Salario_diario));
            $html = View::make('Transmasivo.rh.contratoWord', $data)->render();
    
            // Crear un nuevo documento de Word
            $phpWord = new PhpWord();
        
            // Configurar el tamaño de la página a carta (8.5 x 11 pulgadas)
            $section = $phpWord->addSection([
                'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
                'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
            ]);
        
            // Agregar el HTML al documento de Word
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
        
            // Guardar el documento
            $filename = 'Contrato '.$personal[0]->Nombre.'.docx';
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save(public_path($filename));
        
            // Descargar el documento
            return response()->download(public_path($filename))->deleteFileAfterSend(true);
            
        }
        if($request->has('Actualizar'))
        {
           // dd($request->input('id_personal_modal'));
            $id_operador = auth()->id();
            $user = auth()->user();
            $personal = TPersonal::find($request->input('id_personal_modal'));
            $personal->Nombre= $request->input('nombre');
            $personal->Edad= $request->input('Edad');
            $personal->Fecha_nacimiento= $request->input('nacimiento');
            $personal->Nacionalidad= $request->input('Nacionalidad');
            $personal->Sexo= $request->input('Sexo');
            $personal->Estado_civil= $request->input('Civil');
            $personal->Calle= $request->input('Calle');
            $personal->Numero= $request->input('Numero');
            $personal->Colonia= $request->input('Colonia');
            $personal->Alcaldia_municipio= $request->input('Alcaldia');
            $personal->Estado= $request->input('Estado');
            $personal->Codigo_postal= $request->input('postal');
            $personal->RFC= $request->input('RFC');
            $personal->NSS= $request->input('IMSS');
            $personal->CURP= $request->input('CURP');
            $personal->Correo= $request->input('Correo');
            $personal->Puesto= $request->input('Puesto');
            $personal->Salario_diario= $request->input('Salario_diario');
            $personal->Fecha_contrato= $request->input('fecha_contrato_hidden');
            $personal->Fecha_contrato_date= $request->input('fecha_contrato');
            $personal->Estatus= 'Activo';
            $personal->Fecha_real= now();
            $personal->id_operador = $id_operador;
            $personal->save();
            
            $mensaje="Se actualizo la información de ". $request->input('nombre')." con exito!";
            $color="success";
           
           return redirect()->route('Personal')->with('mensaje', $mensaje)->with('color', $color);


        }
    }
    
    public function Permisos()
    {  
        $nombre = auth()->user()->name; 
        $id = auth()->user()->id; 
        $tipo_usuario = auth()->user()->tipo_usuario;       
        return view('Transmasivo.rh.Permisos', compact('nombre','id','tipo_usuario'));
    }
    public function PermisosPOST(Request $request)
    {
        
        $result = [];
        
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
            
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        if($request->input('incidencia')== "Permiso especial")
        {
            $result['nombre'] = $request->input('nombre');
            $result['id_empleado_h'] = $request->input('id_empleado_h');
            $result['area'] = $request->input('area');
            $result['jefe_inmediato'] = $request->input('jefe_inmediato');
            $result['autorizacion_rh_h'] = $request->input('autorizacion_rh_h');
            $result['autorizacion_dir_h'] = $request->input('autorizacion_dir_h');
            $result['incidencia'] = $request->input('incidencia');
            $result['fecha_inicio'] = $request->input('fecha_inicio');
            $result['fecha_fin'] = $request->input('fecha_fin');
            $result['motivo_solicitud'] = $request->input('motivo_solicitud');
            $result['soportes_anexos'] = $request->input('soportes_anexos');

            DB::connection('mysql')->table('t_incidencias')->insert([
                'id_elemento' => $request->input('id_empleado_h'),
                'Incidencia' => $request->input('incidencia'),
                'motivo_solicitud' => $request->input('motivo_solicitud'),
                'soporte_anexo' => $request->input('soportes_anexos'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_termino' => $request->input('fecha_fin'),
                'fecha_registro' => $hora_formateada,
                'estatus_jefe_directo' => 'Pendiente',
                'estatus_rh' => 'Pendiente',
                'estatus_direccion' => 'Pendiente',
            ]);
            
            return redirect()->route('Permisos')->with('mensaje', 'Se registro tu permiso especial !!')->with('color', 'success');
        } 
        if($request->input('incidencia') == "Vacaciones")
        {
            $result['nombre'] = $request->input('nombre');
            $result['id_empleado_h'] = $request->input('id_empleado_h');
            $result['area'] = $request->input('area');
            $result['jefe_inmediato'] = $request->input('jefe_inmediato');
            $result['autorizacion_rh_h'] = $request->input('autorizacion_rh_h');
            $result['autorizacion_dir_h'] = $request->input('autorizacion_dir_h');
            $result['incidencia'] = $request->input('incidencia');
            $result['fecha_inicio'] = $request->input('fecha_inicio');
            $result['fecha_fin'] = $request->input('fecha_fin');
            DB::connection('mysql')->table('t_incidencias')->insert([
                'id_elemento' => $request->input('id_empleado_h'),
                'Incidencia' => $request->input('incidencia'),
                'fecha_inicio' => $request->input('fecha_inicio'),
                'fecha_termino' => $request->input('fecha_fin'),
                'fecha_registro' => $hora_formateada,
                'estatus_jefe_directo' => 'Pendiente',
                'estatus_rh' => 'Pendiente',
                'estatus_direccion' => 'Pendiente',
            ]);
            return redirect()->route('Permisos')->with('mensaje', 'Se registraron tus vacaciones !!')->with('color', 'success');

        }
        
        $html = view('Transmasivo.rh.pdf_permiso', compact('result'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Carta', 'landscape'); 
        $dompdf->render();
        return $dompdf->stream('Permiso_'.$request->input('incidencia').'.pdf');
    }
    public function Consultar_permisos()
    {        
        $nombre = auth()->user()->name; 
        Carbon::setLocale('es');
        $id = auth()->user()->id; 
        $tipo_usuario = auth()->user()->tipo_usuario; 
        $consulta=DB::connection('mysql')->table('t_incidencias')->where('id_elemento',$id)->get();
        return view('Transmasivo.rh.Consultar_permisos', compact('nombre','id','tipo_usuario','consulta'));
    }
    public function postConsultar_permiso(Request $request)
    {
        $id=$request->input('id_h');
        $result=DB::connection('mysql')->table('t_incidencias')->where('id',$id)->get();
        $html = view('Transmasivo.rh.pdf_permiso', compact('result'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Carta', 'landscape'); 
        $dompdf->render();
        return $dompdf->stream('Permiso_'.$request->input('incidencia').'.pdf');
    }
    public function Gestión_de_permisos()
    {
        $nombre = auth()->user()->name;
        Carbon::setLocale('es');
        $id = auth()->user()->id;
        $tipo_usuario = auth()->user()->tipo_usuario;
        $consulta = DB::table('t_incidencias as t')
        ->join('users as u', 'u.id', '=', 't.id_elemento')
        ->select('t.*', 'u.name')
        ->get();
    
        return view('Transmasivo.rh.Gestión_de_permisos', compact('nombre','id','tipo_usuario','consulta'));
    }
    public function postGestión_de_permisos(Request $request)
    {
        if($request->input('Aprobado') == "Aprobar")
        {
            $id_h=$request->input('id_h');
            $consulta=DB::connection('mysql')->table('t_incidencias')->where('id', $id_h)->update(['estatus_jefe_directo' => 'Aprobado']);
            $mensaje="Se aprobo el permiso!!";
            $color="success";
            return redirect()->route('Gestión_de_permisos')->with('mensaje', $mensaje)->with('color', $color);
        }
        if ($request->input('Rechazar') == "Confirmar") {
            $id_h = $request->input('id_h_m');
            $observaciones = $request->input('observaciones');
            $consulta = DB::connection('mysql')->table('t_incidencias')->where('id', $id_h)->update([
                'estatus_jefe_directo' => 'Rechazado',
                'observaciones' => 'Observacion del jefe directo: ' . $observaciones
            ]);
            $mensaje = "Se rechazó el permiso!!";
            $color = "success";
            return redirect()->route('Gestión_de_permisos')->with('mensaje', $mensaje)->with('color', $color);
        }
        
    }
    public function subir_biometrico()
    {
        return view('Transmasivo.rh.subir_biometrico');
    }
    public function post_subir_biometrico(Request $request)
    {
        
        $request->validate([
            'uploadImg' => 'required|file|mimes:xls,xlsx'
        ]);

        try {
            $filePath = $request->file('uploadImg')->store('temp');
            $import = new importarBiometrico();
            Excel::import($import, storage_path('app/' . $filePath));
            $result = $import->result;
            //dd($result);
            for($i=0; count($result) > $i; $i++)
            {
                DB::connection('mysql')->table('t_biometrico')->insert([
                    'id_elemento' => $result[$i]['id'],
                    'fecha_hora' => $result[$i]['fecha_hora'],
                ]);
            }
            $mensaje = "Archivo importado correctamente!";
            $color = "success";
        } catch (\Exception $e) {
            $mensaje = "Error al importar el archivo: " . $e->getMessage();
            $color = "danger";
        }

        return redirect()->route('subir_biometrico')->with('mensaje', $mensaje)->with('color', $color);
    }

    public function consultar_biometrico()
    {
        $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
        
        $consulta=DB::connection('mysql')->select("SELECT id_elemento,DATE(fecha_hora) AS dia, MIN(fecha_hora) AS inicio,MAX(fecha_hora) AS fin,
                                                        TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                        CASE 
                                                            WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                            ELSE 'En tiempo'
                                                        END AS estado,
                                                        GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR ', ') AS todas_las_fechas
                                                    FROM 
                                                        t_biometrico
                                                    GROUP BY 
                                                        id_elemento, dia;");
        $id_ele="-Selecciona-";
        $consulta="";
        $fecha_fin=null;
        $fecha_inicio=null;
        return view('Transmasivo.rh.consultar_biometrico',compact('consulta','elementos','id_ele','fecha_fin','fecha_inicio'));
    }
    public function post_consultar_biometrico(Request $request)
    {
        $id_empleado=$request->input('id_empleado');
        $qna=$request->input('qna');
        $fecha_inicio=$request->input('fecha_inicio').' 00:00:00';
        $fecha_fin=$request->input('fecha_fin').' 23:59:59';
        
        $id_ele=$id_empleado;
        $consulta;
        $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
        if($id_empleado!="-Selecciona-" && $request->input('fecha_inicio') != null && $request->input('fecha_fin') != null){

            $consulta = DB::connection('mysql')->select(
            "SELECT 
                                                        id_elemento,
                                                        DATE(fecha_hora) AS dia,
                                                        MIN(fecha_hora) AS inicio,
                                                        MAX(fecha_hora) AS fin,
                                                        TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                        CASE 
                                                            WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                            ELSE 'En tiempo'
                                                        END AS estado,
                                                        GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR '<br> ') AS todas_las_fechas
                                                    FROM 
                                                        t_biometrico WHERE id_elemento=? and fecha_hora BETWEEN ? AND ?
                                                    GROUP BY 
                                                        id_elemento, dia;", [$id_empleado,$fecha_inicio, $fecha_fin]);

        }
        
        else if ($request->input('fecha_inicio') != null && $request->input('fecha_fin') != null) {
            $consulta = DB::connection('mysql')->select("
                SELECT 
                                                        id_elemento,
                                                        DATE(fecha_hora) AS dia,
                                                        MIN(fecha_hora) AS inicio,
                                                        MAX(fecha_hora) AS fin,
                                                        TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                        CASE 
                                                            WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                            ELSE 'En tiempo'
                                                        END AS estado,
                                                        GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR '<br> ') AS todas_las_fechas
                                                    FROM 
                                                        t_biometrico WHERE fecha_hora BETWEEN ? AND ?
                                                    GROUP BY 
                                                        id_elemento, dia;
            ", [$fecha_inicio, $fecha_fin]);
    
        }
        else if($id_empleado!="-Selecciona-"){
            $consulta = DB::connection('mysql')->select("
            SELECT 
                                                        id_elemento,
                                                        DATE(fecha_hora) AS dia,
                                                        MIN(fecha_hora) AS inicio,
                                                        MAX(fecha_hora) AS fin,
                                                        TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                        CASE 
                                                            WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                            ELSE 'En tiempo'
                                                        END AS estado,
                                                        GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR '<br> ') AS todas_las_fechas
                                                    FROM 
                                                        t_biometrico WHERE id_elemento=? 
                                                    GROUP BY 
                                                        id_elemento, dia;
        ", [$id_empleado]);
        
        }
        else{
            $consulta = DB::connection('mysql')->select("
           SELECT 
                                                        id_elemento,
                                                        DATE(fecha_hora) AS dia,
                                                        MIN(fecha_hora) AS inicio,
                                                        MAX(fecha_hora) AS fin,
                                                        TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                        CASE 
                                                            WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                            ELSE 'En tiempo'
                                                        END AS estado,
                                                        GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR '<br> ') AS todas_las_fechas
                                                    FROM 
                                                        t_biometrico
                                                    GROUP BY 
                                                        id_elemento, dia;
        ");
        }
       
        Carbon::setLocale('es');

       // Suponiendo que $consulta es tu colección de datos
        foreach($consulta as $consul) {
            // Reemplazar las etiquetas <br> por comas y luego eliminar espacios en blanco adicionales
            $fechas_html = str_replace('<br>', ',', $consul->todas_las_fechas);

            // Convertir la cadena de fechas a un array utilizando una coma como delimitador
            $fechas = explode(',', $fechas_html);

            // Eliminar espacios y duplicados
            $fechas = array_map('trim', $fechas);
            $fechas_unicas = array_unique($fechas);

            // Filtrar las fechas vacías
            $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));

            // Formatear las fechas
            $fechas_formateadas = array_map(function($fecha) {
                return Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
            }, $fechas_unicas);

            // Convertir el array de nuevo a una cadena
            $consul->todas_las_fechas = implode('<br>', $fechas_formateadas);
        }
        $fecha_inicio=$request->input('fecha_inicio');
        $fecha_fin=$request->input('fecha_fin');
        return view('Transmasivo.rh.consultar_biometrico',compact('consulta','elementos','id_ele','fecha_fin','fecha_inicio'));
    }
    
    public function Solicitar_herramienta()
    {
        return view('Transmasivo.rh.consultar_biometrico',compact('consulta','elementos','id_ele'));
    }
    
    public function Contrato_Dasimo() {
        return view('Transmasivo.rh.Contrato_Dasimo');
    }
    public function Registro_Contrato_Dasimo(Request $request) {
        // Extraer los datos del request
        $nombre=$request->input('nombre');
        $nacimiento=$request->input('nacimiento');
        $Edad=$request->input('edad');
        $Puesto=$request->input('puesto');
        $Nacionalidad=$request->input('Nacionalidad');
        $Sexo=$request->input('Sexo');
        $Civil=$request->input('Civil');
        $Calle=$request->input('calle');
        $Colonia=$request->input('colonia');
        $Alcaldia=$request->input('Alcaldia');
        $Estado=$request->input('Estado');
        $Postal=$request->input('postal');
        $rfc=$request->input('rfc');
        $imss=$request->input('imss');
        $numero=$request->input('numero');
        $id_empleado=$request->input('id_empleado');
        
        
        $curp=$request->input('curp');
        $rfc=$request->input('rfc');
        $correo=$request->input('correo');
        $Sueldo=$request->input('Sueldo');
        $fecha_contrato=$request->input('fecha_contrato');
        $fecha_contrato_hidden=$request->input('fecha_contrato_hidden');
        $generar=$request->input('generar');
        $data=["nombre"=>$nombre,"nacimiento"=>$nacimiento,"Edad"=>$Edad,"Puesto"=>$Puesto,
        "Nacionalidad"=>$Nacionalidad,"Sexo"=>$Sexo,"Civil"=>$Civil,"Calle"=>$Calle,"Colonia"=>$Colonia,"Alcaldia"=>$Alcaldia,"Estado"=>$Estado,"Postal"=>$Postal,"RFC"=>$rfc,"Sueldo"=>$Sueldo,
        "IMSS"=>$imss,"id_empleado"=>$id_empleado,"CURP"=>$curp,"Numero"=>$numero,"postal"=>$Postal,"Correo"=>$correo,"fecha_contrato"=>$fecha_contrato,"fecha_contrato_hidden"=>$fecha_contrato_hidden,"generar"=>$generar];
    
        // Generar el HTML de la vista
        $html = View::make('Transmasivo.rh.contratoWordDasimo', $data)->render();
    
        // Validar y limpiar el HTML (opcional)
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        $cleanHtml = $purifier->purify($html);
    
        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
    
        // Configurar el tamaño de la página a carta (8.5 x 11 pulgadas)
        $section = $phpWord->addSection([
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
        ]);
    
        // Agregar el HTML al documento de Word
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $cleanHtml);
    
        // Guardar el documento
        $filename = 'Contrato ' . $data['nombre'] . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path($filename));
    
        // Descargar el documento
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }
            
    public function Consultar_biometricos_usuario()
    {
        $id = auth()->user()->id; 
        $consulta = DB::connection('mysql')->select("SELECT id_elemento, DATE(fecha_hora) AS dia, MIN(fecha_hora) AS inicio,  MAX(fecha_hora) AS fin,
                                                    TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
                                                    CASE 
                                                        WHEN TIME(MIN(fecha_hora)) > '09:00:00' THEN 'Retardo'
                                                        ELSE 'En tiempo'
                                                    END AS estado,
                                                    GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR '<br> ') AS todas_las_fechas
                                                FROM t_biometrico WHERE id_elemento=?  GROUP BY  id_elemento, dia;", [$id]);
       Carbon::setLocale('es');

       // Suponiendo que $consulta es tu colección de datos
        foreach($consulta as $consul) {
            // Reemplazar las etiquetas <br> por comas y luego eliminar espacios en blanco adicionales
            $fechas_html = str_replace('<br>', ',', $consul->todas_las_fechas);

            // Convertir la cadena de fechas a un array utilizando una coma como delimitador
            $fechas = explode(',', $fechas_html);

            // Eliminar espacios y duplicados
            $fechas = array_map('trim', $fechas);
            $fechas_unicas = array_unique($fechas);

            // Filtrar las fechas vacías
            $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));

            // Formatear las fechas
            $fechas_formateadas = array_map(function($fecha) {
                return Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
            }, $fechas_unicas);

            // Convertir el array de nuevo a una cadena
            $consul->todas_las_fechas = implode('<br>', $fechas_formateadas);
        }


        return view('Transmasivo.rh.Consultar_biometricos_usuario',compact('consulta'));
    }


}
