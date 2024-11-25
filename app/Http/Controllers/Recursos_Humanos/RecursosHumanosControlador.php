<?php

namespace App\Http\Controllers\Recursos_Humanos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Models\TPersonal;
use App\Models\t_entrevista_salida;
use App\Imports\importarBiometrico;

use App\Exports\BiometricoExport;
use App\Exports\BiometricoExport2;
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
    public function descargarRenuncia(Request $request)
{
    $Empresa = $request->input('Empresa');
    $nombre = $request->input('nombre');
    $inicio = Carbon::parse($request->input('inicio'))->locale('es')->translatedFormat('l, d \d\e F \d\e\l Y');
    $fin = Carbon::parse($request->input('fin'))->locale('es')->translatedFormat('l, d \d\e F \d\e\l Y');
    $elaboracion = Carbon::parse($request->input('elaboracion'))->locale('es')->translatedFormat('l, d \d\e F \d\e\l Y');
    $Puesto = $request->input('Puesto');

    $html = View::make('Transmasivo.rh.renunciasWord', compact('Empresa', 'nombre', 'inicio', 'fin', 'elaboracion', 'Puesto'))->render();

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
    $filename = 'Renuncia ' . $nombre . '.docx';
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save(public_path($filename));

    // Descargar el documento
    return response()->download(public_path($filename))->deleteFileAfterSend(true);
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
            'apellido_p' => $request->input('apellido_p'),
            'apellido_m' => $request->input('apellido_m'),
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
        $personal->id_empleado= $request->input('empleado');
        $personal->apellido_p= $request->input('apellido_p');
        $personal->apellido_m= $request->input('apellido_m');
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
        $html = View::make('Transmasivo.rh.contratoWord', $data)->render();
        $phpWord = new PhpWord();
        $section = $phpWord->addSection([
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
        ]);
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
        $filename = 'Contrato '.$request->input('nombre').'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(public_path($filename));

        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }

    public function Gestion_del_personal()
    {
        $consulta = DB::connection('mysql')->select('select * from t_personal where Estatus="Activo" ');
        $c_departamento = DB::connection('mysql')->select('select * from c_departamento');
        $t_horarios_personal = DB::connection('mysql')->select('select * from t_horarios_personal where estatus="Activo"');
        $c_nivel_estudio = DB::connection('mysql')->select('select * from c_nivel_estudio ');
        $c_banco = DB::connection('mysql')->select('select * from c_banco ');
        return view('Transmasivo.rh.Gestion_del_personal', compact('consulta','c_departamento','t_horarios_personal','c_nivel_estudio','c_banco'));
    }

    public function postGestion_del_personal(Request $request)
    {
        
        if($request->has('baja')){
            
            DB::connection('mysql')->table('t_personal')
            ->where('id_personal', $request->input('id_personal'))
            ->update(['estatus' => 'Baja']);
            $mensaje="El usuario se dio de baja con exito!";
            $color="success";
           
           return redirect()->route('Gestion_del_personal')->with('mensaje', $mensaje)->with('color', $color);
        }
        if($request->has('Reimprimir')){
            
            $personal = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal inner join users on users.id=t_personal.id_operador where t_personal.id_personal='.$request->input('id_personal'));
            
            $id_operador = auth()->id();
            $user = auth()->user();
            $data = [
                'user' => $user,
                'nombre' =>$personal[0]->Nombre,
                'apellido_p' =>$personal[0]->apellido_p,
                'apellido_m' =>$personal[0]->apellido_m,
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

            $html = View::make('Transmasivo.rh.contratoWord', $data)->render();
            $phpWord = new PhpWord();
            $section = $phpWord->addSection([
                'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.5),
                'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::inchToTwip(11)
            ]);
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
            $filename = 'Contrato '.$personal[0]->Nombre.'.docx';
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save(public_path($filename));
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

    public function Personal()
    {
        $mensaje = session('mensaje');
        $color = session('color');
        $consulta = DB::connection('mysql')->select('select t_personal.*, users.name from t_personal left join users on t_personal.id_operador=users.id');
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
        $currentYear = \Carbon\Carbon::now()->year;
        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $quincenas = [];
        $j = 1;
        $selectedQna = '';
                            // Generar todas las quincenas del año
                            for ($month = 1; $month <= 12; $month++) {
                                // Primera quincena del mes
                                $startFirstHalf = \Carbon\Carbon::create($currentYear, $month, 1)->format('Y-m-d');
                                $endFirstHalf = \Carbon\Carbon::create($currentYear, $month, 15)->format('Y-m-d');
                                $quincenaValueFirstHalf = "'$startFirstHalf 00:00:00' AND '$endFirstHalf 23:59:59'";
                                $quincenas[] = [
                                    'label' => "Qna ".$j." - 1 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - 15 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                                    'value' => $quincenaValueFirstHalf
                                ];
                                if ($today >= $startFirstHalf && $today <= $endFirstHalf) {
                                    $selectedQna = $quincenaValueFirstHalf;
                                }
                                $j++;
                                // Segunda quincena del mes
                                $startSecondHalf = \Carbon\Carbon::create($currentYear, $month, 16)->format('Y-m-d');
                                $endSecondHalf = \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->format('Y-m-d');
                                $quincenaValueSecondHalf = "'$startSecondHalf 00:00:00' AND '$endSecondHalf 23:59:59'";
                                $quincenas[] = [
                                    'label' => "Qna ".$j." - 16 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - " . \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->day . " de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                                    'value' => $quincenaValueSecondHalf
                                ];
                                if ($today >= $startSecondHalf && $today <= $endSecondHalf) {
                                    $selectedQna = $quincenaValueSecondHalf;
                                }
                                $j++;
                            }

        
        //dd( $selectedQna);
        $elementos = DB::connection('mysql')->select(
            'SELECT DISTINCT id_elemento FROM t_biometrico where id_elemento!="" ORDER BY id_elemento asc;');
        
        $id_ele="-Selecciona-";
        $consulta="";
        $fecha_fin=null;
        $fecha_inicio=null;
        $qna=null;
        $jornadas = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal ');
        return view('Transmasivo.rh.consultar_biometrico',compact('jornadas','qna','consulta','elementos','id_ele','fecha_fin','fecha_inicio'));
    }
    
    public function consultar_biometrico2()
    {
        $currentYear = \Carbon\Carbon::now()->year;
        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $quincenas = [];
        $j = 1;
        $selectedQna = '';
                            // Generar todas las quincenas del año
                            for ($month = 1; $month <= 12; $month++) {
                                // Primera quincena del mes
                                $startFirstHalf = \Carbon\Carbon::create($currentYear, $month, 1)->format('Y-m-d');
                                $endFirstHalf = \Carbon\Carbon::create($currentYear, $month, 15)->format('Y-m-d');
                                $quincenaValueFirstHalf = "'$startFirstHalf 00:00:00' AND '$endFirstHalf 23:59:59'";
                                $quincenas[] = [
                                    'label' => "Qna ".$j." - 1 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - 15 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                                    'value' => $quincenaValueFirstHalf
                                ];
                                if ($today >= $startFirstHalf && $today <= $endFirstHalf) {
                                    $selectedQna = $quincenaValueFirstHalf;
                                }
                                $j++;
                                // Segunda quincena del mes
                                $startSecondHalf = \Carbon\Carbon::create($currentYear, $month, 16)->format('Y-m-d');
                                $endSecondHalf = \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->format('Y-m-d');
                                $quincenaValueSecondHalf = "'$startSecondHalf 00:00:00' AND '$endSecondHalf 23:59:59'";
                                $quincenas[] = [
                                    'label' => "Qna ".$j." - 16 de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " - " . \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth()->day . " de " . \Carbon\Carbon::create($currentYear, $month, 1)->translatedFormat('F') . " $currentYear",
                                    'value' => $quincenaValueSecondHalf
                                ];
                                if ($today >= $startSecondHalf && $today <= $endSecondHalf) {
                                    $selectedQna = $quincenaValueSecondHalf;
                                }
                                $j++;
                            }

        
        //dd( $selectedQna);
       
        $id_ele="-Selecciona-";
        $consulta="";
        $fecha_fin=null;
        $fecha_inicio=null;
        $qna=null;
        $jornadas = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal ');
        $fechas_qna = DB::connection('mysql')->select(
            'SELECT DISTINCT DATE(fecha_hora) AS fecha
            FROM t_biometrico
            WHERE fecha_hora BETWEEN '.$selectedQna.' order by fecha asc;'
        );
        $elementos = DB::connection('mysql')->select(
            'SELECT DISTINCT id_elemento FROM t_biometrico where id_elemento!="" and fecha_hora between '.$selectedQna.' ORDER BY id_elemento asc;'
        );
        $array_completo=null;
        //dd($fechas_qna);
        return view('Transmasivo.rh.consultar_biometrico2',compact('jornadas','array_completo','fechas_qna','qna','consulta','elementos','id_ele','fecha_fin','fecha_inicio'));
    }
    public function obtenerDiaSemana($fecha) {
        $timestamp = strtotime($fecha);
        $diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $numeroDia = date('w', $timestamp);
        return $diasSemana[$numeroDia];
    }
    public function post_consultar_biometrico2(Request $request)
    {
        if($request->has('Consultar'))
        {
            //dd($request->all());
            $array_completo = []; // Inicializa un array vacío
            $id_empleado=$request->input('id_empleado');
            $qna=$request->input('qna');
            $elementos = [];

            if ($request->input('id_empleado') === "-Selecciona-") {
                
                $elementos = DB::connection('mysql')->select(
                    "SELECT DISTINCT id_elemento 
                    FROM t_biometrico 
                    WHERE  fecha_hora BETWEEN ".$qna." 
                    ORDER BY id_elemento ASC"
                );
            } else {
                $elementos[] = (object)[
                    'id_elemento' => $request->input('id_empleado')
                ];
            }
            //dd($elementos);

            $union_tablas = DB::connection('mysql')->select(
                'SELECT * FROM t_horarios_enrolador_personal where fecha_inicio between '.$qna.' or fecha_fin between '.$qna.' ORDER BY id_empleado asc'
            );
            $t_horarios = DB::connection('mysql')->select(
                'SELECT * FROM t_horarios_personal '
            );
            $t_biometrico = DB::connection('mysql')->select(
                'SELECT * FROM t_biometrico where fecha_hora between '.$qna.' order by id_elemento'
            );


            //dd($union_tablas);
            $horario_tiene = []; // Inicializa un array vacío
            for($i = 0 ; count($elementos) > $i ; $i++)
            {
                $valida = DB::connection('mysql')->select(
                    'SELECT * FROM t_horarios_enrolador_personal where id_empleado = '.$elementos[$i]->id_elemento.' order by fecha_inicio desc LIMIT 4'
                );
                if($valida){
                    $n_registros = count($valida);
                    if ($n_registros == 4)
                    { 
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_i'] = $valida[0]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_f'] = $valida[0]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_id'] = $valida[0]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_i'] = $valida[1]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_f'] = $valida[1]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_id'] = $valida[1]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_i'] = $valida[2]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_f'] = $valida[2]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_id'] = $valida[2]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_i'] = $valida[3]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_f'] = $valida[3]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_id'] = $valida[3]->id_horario;
                    }else if($n_registros == 3)
                    {
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_i'] = $valida[0]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_f'] = $valida[0]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_id'] = $valida[0]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_i'] = $valida[1]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_f'] = $valida[1]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_id'] = $valida[1]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_i'] = $valida[2]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_f'] = $valida[2]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_id'] = $valida[2]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_id'] = 'Sin Horario';
                    }else if($n_registros == 2)
                    {
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_i'] = $valida[0]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_f'] = $valida[0]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_id'] = $valida[0]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_i'] = $valida[1]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_f'] = $valida[1]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_id'] = $valida[1]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_id'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_id'] = 'Sin Horario';

                    }else if($n_registros == 1)
                    {
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_i'] = $valida[0]->fecha_inicio;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_f'] = $valida[0]->fecha_fin;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_1_id'] = $valida[0]->id_horario;
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_2_id'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_3_id'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_i'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_f'] = 'Sin Horario';
                        $horario_tiene[$elementos[$i]->id_elemento]['horario_4_id'] = 'Sin Horario';

                    }
                }else{
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_1_i'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_1_f'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_1_id'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_2_i'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_2_f'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_2_id'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_3_i'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_3_f'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_3_id'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_4_i'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_4_f'] = 'Sin Horario';
                    $horario_tiene[$elementos[$i]->id_elemento]['horario_4_id'] = 'Sin Horario';
                }
            }
            $fechas_qna = DB::connection('mysql')->select(
                'SELECT DISTINCT DATE(fecha_hora) AS fecha
                FROM t_biometrico
                WHERE fecha_hora BETWEEN '.$qna.' order by fecha asc;'
            );
            for($i = 0 ; count($fechas_qna) > $i ; $i++)
            {
                for($j=0 ; count($elementos) > $j ; $j++)
                {
                    $id_horario =null;
                        $fecha_inicio = $horario_tiene[$elementos[$j]->id_elemento]['horario_1_i'];
                        $fecha_fin = $horario_tiene[$elementos[$j]->id_elemento]['horario_1_f'];
                        if($fecha_fin == null)
                        {
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_1_id'];
                        }else if($fecha_inicio < $fechas_qna[$i]->fecha && $fecha_fin > $fechas_qna[$i]->fecha )
                        {
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_1_id'];
                        }
                       
                        $fecha_inicio = $horario_tiene[$elementos[$j]->id_elemento]['horario_2_i'];
                        $fecha_fin = $horario_tiene[$elementos[$j]->id_elemento]['horario_2_f'];
                        if($fecha_fin == null)
                        {
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_2_id'];
                        }
                        else if($fecha_inicio < $fechas_qna[$i]->fecha && $fecha_fin > $fechas_qna[$i]->fecha )
                        {          
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_2_id'];                     
                        }
                    
                        
                        $fecha_inicio = $horario_tiene[$elementos[$j]->id_elemento]['horario_3_i'];
                        $fecha_fin = $horario_tiene[$elementos[$j]->id_elemento]['horario_3_f'];
                        if($fecha_fin == null)
                        {
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_3_id'];
                        }
                        else if($fecha_inicio < $fechas_qna[$i]->fecha && $fecha_fin > $fechas_qna[$i]->fecha )
                        {                       
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_3_id'];            
                        }
                        $fecha_inicio = $horario_tiene[$elementos[$j]->id_elemento]['horario_4_i'];
                        $fecha_fin = $horario_tiene[$elementos[$j]->id_elemento]['horario_4_f'];
                        if($fecha_fin == null)
                        {
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_4_id'];
                        }
                        else if($fecha_inicio < $fechas_qna[$i]->fecha && $fecha_fin > $fechas_qna[$i]->fecha )
                        {    
                            $id_horario = $horario_tiene[$elementos[$j]->id_elemento]['horario_4_id'];                                          
                        }

                        
                   
                    $t_horario;
                    if($id_horario !== null){
                        $t_horario = DB::connection('mysql')->select(
                            'SELECT * FROM t_horarios_personal where id_t_horarios_personal='.$id_horario
                        );
                    }
                    if($elementos[$j]->id_elemento == 182)
                        {
                           //dd($t_horario);
                           //dd($t_horario);
                        }
                    //dd($t_horario);
                    $fecha = $fechas_qna[$i]->fecha;
                    $diaSemana = $this->obtenerDiaSemana($fecha);
                    $h_ll;
                    $h_ll_c;
                    $h_s_c;
                    $h_s;
                    if($t_horario)
                    {
                        if($diaSemana == "Lunes")
                        {
                            if($t_horario[0]->jornada_l == "Jornada de lunes" )
                            {
                                //llegada
                                
                                $h_ll = $t_horario[0]->hora_llegada_l;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_l;
                                $h_s_c = $t_horario[0]->hora_fin_comida_l;
                                $h_s = $t_horario[0]->hora_salida_l;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_l == "Jornada de lunes a martes" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_l;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_l;
                                $h_s_c = $t_horario[0]->hora_fin_comida_l;
                                $h_s = $t_horario[0]->hora_salida_l;
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    //dd($hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_l == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                            }
                            
                        }
                        if($diaSemana == "Martes")
                        {
                            if($t_horario[0]->jornada_m == "Jornada de martes" )
                            {
                                //llegada
                                $h_ll = $t_horario[0]->hora_llegada_m;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_m;
                                $h_s_c = $t_horario[0]->hora_fin_comida_m;
                                $h_s = $t_horario[0]->hora_salida_m;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_m == "Jornada de martes a miércoles" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_m;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_m;
                                $h_s_c = $t_horario[0]->hora_fin_comida_m;
                                $h_s = $t_horario[0]->hora_salida_m;
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_m == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                                
                            }

                        }
                        if($diaSemana == "Miércoles")
                        {
                            if($t_horario[0]->jornada_mi == "Jornada de miércoles" )
                            {
                                //llegada
                                
                                $h_ll = $t_horario[0]->hora_llegada_mi;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_mi;
                                $h_s_c = $t_horario[0]->hora_fin_comida_mi;
                                $h_s = $t_horario[0]->hora_salida_mi;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_mi == "Jornada de miércoles a jueves" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_mi;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_mi;
                                $h_s_c = $t_horario[0]->hora_fin_comida_mi;
                                $h_s = $t_horario[0]->hora_salida_mi;
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_mi == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                                
                            }

                        }
                        if($diaSemana == "Jueves")
                        {
                            if($t_horario[0]->jornada_j == "Jornada de jueves" )
                            {
                                //llegada
                                
                                $h_ll = $t_horario[0]->hora_llegada_j;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_j;
                                $h_s_c = $t_horario[0]->hora_fin_comida_j;
                                $h_s = $t_horario[0]->hora_salida_j;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_j == "Jornada de jueves a viernes" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_j;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_j;
                                $h_s_c = $t_horario[0]->hora_fin_comida_j;
                                $h_s = $t_horario[0]->hora_salida_j;
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_j == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                                
                            }

                        }
                        if($diaSemana == "Viernes")
                        {
                            if($t_horario[0]->jornada_v == "Jornada de viernes" )
                            {
                                //llegada
                                
                                $h_ll = $t_horario[0]->hora_llegada_v;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_v;
                                $h_s_c = $t_horario[0]->hora_fin_comida_v;
                                $h_s = $t_horario[0]->hora_salida_v;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_v == "Jornada de viernes a sábado" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_v;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_v;
                                $h_s_c = $t_horario[0]->hora_fin_comida_v;
                                $h_s = $t_horario[0]->hora_salida_v;
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_v == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                                
                            }

                        }
                        if($diaSemana == "Sábado")
                        {
                            if($t_horario[0]->jornada_s == "Jornada de sábado" )
                            {
                                //llegada
                                
                                $h_ll = $t_horario[0]->hora_llegada_s;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_s;
                                $h_s_c = $t_horario[0]->hora_fin_comida_s;
                                $h_s = $t_horario[0]->hora_salida_s;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    
                                    //salida
                                    $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_s;
                                    $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_s == "Jornada de sábado a domingo" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_s;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_s;
                                $h_s_c = $t_horario[0]->hora_fin_comida_s;
                                $h_s = $t_horario[0]->hora_salida_s;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                               
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                    $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                    }else{
                                      
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                    }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_s == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                            }

                        }
                        if($diaSemana == "Domingo")
                        {
                            if($t_horario[0]->jornada_d == "Jornada de domingo" )
                            {
                                //llegada
                                $h_ll = $t_horario[0]->hora_llegada_d;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_d;
                                $h_s_c = $t_horario[0]->hora_fin_comida_d;
                                $h_s = $t_horario[0]->hora_salida_d;
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'asc');
                                if($resultado){
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_ll;
                                $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                
                                //salida
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha, 'desc');
                                $hora_llegada_real = $resultado[0]->fecha_hora;
                                $hora_llegada_jornada = $fecha.' '.$h_s;
                                $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                            }
                            if($t_horario[0]->jornada_d == "Jornada de domingo a lunes" )
                            {
                                $h_ll = $t_horario[0]->hora_llegada_d;
                                $h_ll_c = $t_horario[0]->hora_inicio_comida_d;
                                $h_s_c = $t_horario[0]->hora_fin_comida_d;
                                $h_s = $t_horario[0]->hora_salida_d;
                                $fecha2 = $this->aumentarUnDia($fecha);
                                
                                $resultado = $this->consulta_t_biometrico($elementos[$j]->id_elemento , $fecha2, 'asc');
                              // dd($resultado);
                                if($resultado){
                                    $hora_llegada_real = $resultado[0]->fecha_hora;
                                    $hora_llegada_jornada = $fecha.' '.$h_ll;
                                    $estatus = $this->validaestatus($hora_llegada_real , $hora_llegada_jornada);
                                    $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = $hora_llegada_real;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = $hora_llegada_jornada;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = $hora_dif;
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = $estatus;
                                    $fecha_aumenta = $this->aumentarUnDia($fecha);
                                    //salida
                                    $resultado = $this->consulta_t_biometrico_doble_dia($elementos[$j]->id_elemento , $fecha_aumenta, 'asc');
                                    if($resultado){
                                        $hora_llegada_real = $resultado[0]->fecha_hora;
                                        $hora_llegada_jornada = $fecha_aumenta.' '.$h_s;
                                        $estatus = $this->validaestatusS($hora_llegada_real , $hora_llegada_jornada);
                                        $hora_dif = $this->calcular_diferencia ($hora_llegada_real,$hora_llegada_jornada);
                                        
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = $hora_llegada_real;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = $hora_llegada_jornada;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = $hora_dif;
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = $estatus;
                                        }else{
                                          
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = 'Sin datos';
                                        $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = 'Sin datos';  
                                        }
                                    //dd( $array_completo[$elementos[$j]->id_elemento][$fecha]);
                                }else{
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Falta";
                                    $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Falta";
                                }
                                
                            }
                            if($t_horario[0]->jornada_d == "Descanso" )
                            {
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_llegada'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_llegada_estatus'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_r'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_j'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_dif_salida'] = "Descanso";
                                $array_completo[$elementos[$j]->id_elemento][$fecha]['hora_salida_estatus'] = "Descanso";
                            }

                        }
                    }
                    
                    //fin prueba con el primer horario si coincide

                    


                }
            }
            
            //dd($array_completo);

        }else if($request->has('Excel2')){
           
            $id_empleado=$request->input('id_empleado');
            $qna=$request->input('qna');
            $fecha_inicio=$request->input('fecha_inicio').' 00:00:00';
            $fecha_fin=$request->input('fecha_fin').' 23:59:59';
            
            $id_ele=$id_empleado;
            $consulta;

            $where = "";
            $where2 = "";

            if($qna !== "-Selecciona-")
            {
                $where .= " WHERE  fecha_hora BETWEEN ".$qna." ";
            }

            if($id_empleado !== "-Selecciona-")
            {
                $where2 .= "    and   e.id_empleado = ". $id_empleado. " ";
            }


            $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
            $español = DB::connection('mysql')->select("SET lc_time_names = 'es_ES';");
            $consulta = DB::connection('mysql')->select("SELECT 
    e.id_empleado,
    h.nombre_horario,
    h.id_t_horarios_personal,
    b.fecha_hora AS registro_biometrico,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN 'Domingo'
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN 'Lunes'
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN 'Martes'
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN 'Miércoles'
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN 'Jueves'
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN 'Viernes'
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN 'Sábado'
    END AS dia_registro,
    DATE_FORMAT(b.fecha_hora, '%W, %e de %M del %Y') AS fecha_formato_largo,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END AS hora_esperada_llegada,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END AS hora_esperada_salida,
    TIMEDIFF(
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END
) AS horas_trabajo_esperadas,
    CASE 
        WHEN TIME(b.fecha_hora) <= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Tarde'
    END AS estado_llegada,
    TIMEDIFF(
        (SELECT MAX(fecha_hora)
         FROM t_biometrico
         WHERE id_elemento = b.id_elemento 
           AND DATE(fecha_hora) = DATE(b.fecha_hora)),
        b.fecha_hora
    ) AS tiempo_trabajado,
    CASE 
        WHEN TIME((SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora))) >= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Salio antes'
    END AS estado_salida,
    (SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS ultimo_registro_biometrico,
    (SELECT GROUP_CONCAT(DISTINCT fecha_hora ORDER BY fecha_hora SEPARATOR ',<br> ')
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS todos_registros_dia,
    (SELECT COUNT(DISTINCT fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS conteo_todos_registros_dia

FROM 
    t_horarios_enrolador_personal e
JOIN 
    t_horarios_personal h ON e.id_horario = h.id_t_horarios_personal
JOIN 
    (
        SELECT 
            id_elemento, 
            MIN(fecha_hora) AS fecha_hora
        FROM 
            t_biometrico
        ".$where."
        GROUP BY 
            id_elemento, DATE(fecha_hora)
    ) b ON e.id_empleado = b.id_elemento
WHERE 
    (e.fecha_inicio IS NULL OR e.fecha_inicio <= b.fecha_hora) 
    AND (e.fecha_fin IS NULL OR e.fecha_fin >= b.fecha_hora)
    ".$where2."
ORDER BY 
    h.nombre_horario, e.id_empleado, b.fecha_hora ASC;
");


//dd($consulta);
// Separar las fechas de inicio y fin
list($fechaInicio, $fechaFin) = explode(' AND ', $qna);
list($fechaInicio) = explode(' 00:00:00', $fechaInicio);
list($fechaInicio) = explode("''", $fechaInicio);
list($fechaFin) = explode(' 23:59:59', $fechaFin);

$fechaInicio = $fechaInicio."'";
$fechaFin = $fechaFin."'";

// Construir la consulta utilizando las fechas de $qna
$query = "
    WITH RECURSIVE rango_fechas AS (
        SELECT DATE($fechaInicio) AS fecha
        UNION ALL
        SELECT DATE_ADD(fecha, INTERVAL 1 DAY)
        FROM rango_fechas
        WHERE fecha < DATE($fechaFin)
    )
    SELECT fecha
    FROM rango_fechas;
";

// Ejecutar la consulta (esto depende de cómo manejas tus consultas)
$resultados = DB::select($query);

$fechas_formateadas = [];

$dias_semana = [
    'Monday' => 'lunes',
    'Tuesday' => 'martes',
    'Wednesday' => 'miércoles',
    'Thursday' => 'jueves',
    'Friday' => 'viernes',
    'Saturday' => 'sábado',
    'Sunday' => 'domingo'
];

$meses = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

foreach ($resultados as $resultado) {
    // Convertir la fecha a un objeto DateTime
    $fecha = new DateTime($resultado->fecha);

    // Obtener el día de la semana, día del mes, mes y año
    $dia_semana = $dias_semana[$fecha->format('l')];
    $dia = $fecha->format('j');
    $mes = $meses[$fecha->format('F')];
    $año = $fecha->format('Y');

    // Construir la fecha en el formato deseado
    $fechas_formateadas[] = "$dia_semana, $dia de $mes del $año";
}


       $acomodado = []; // Inicializa un array vacío

       for ($i = 0; count($consulta) > $i; $i++) 
       {
            for ($j = 0; count($fechas_formateadas) > $j; $j++) 
            {
                if($fechas_formateadas[$j] == $consulta[$i]->fecha_formato_largo)
                {
                    
                    $acomodado[$consulta[$i]->id_empleado][$j]['fecha_formato_largo'] = $consulta[$i]->fecha_formato_largo;
                    $acomodado[$consulta[$i]->id_empleado][$j]['horas_trabajo_esperadas'] = $consulta[$i]->horas_trabajo_esperadas;
                    $acomodado[$consulta[$i]->id_empleado][$j]['tiempo_trabajado'] = $consulta[$i]->tiempo_trabajado;
                    $acomodado[$consulta[$i]->id_empleado][$j]['id_horario'] = $consulta[$i]->id_t_horarios_personal;
                }
       
            }
        }

        $usuarios_registro = DB::connection('mysql')->select('SELECT distinct(id_elemento) FROM t_biometrico '.$where.' ORDER BY id_elemento ASC');
        //lista de todos los usuarios


       //dd($acomodado[2984]);
        
        for ($i = 0; count($usuarios_registro) > $i; $i++) 
        {
            $idElemento = $usuarios_registro[$i]->id_elemento; // Obtiene el id_elemento actual
            
            // Verifica si el índice $idElemento ya existe en el array $acomodado
            if (isset($acomodado[$idElemento]))
            {
                for ($j = 0; count($fechas_formateadas) > $j; $j++) 
                {
                    
                    if (isset($acomodado[$idElemento][$j]))
                    {
                    }else{

                        //fechas que no existen registrar si fue descanso o falta
                        $fecha_texto = $fechas_formateadas[$j]; 
                        preg_match('/(\d{1,2}) de (\w+) del (\d{4})/', $fecha_texto, $matches);

                        $dia = $matches[1];
                        $mes = $matches[2];
                        $año = $matches[3];

                        // Mapea los meses en español a números
                        $meses = [
                            'enero' => 1, 'febrero' => 2, 'marzo' => 3,
                            'abril' => 4, 'mayo' => 5, 'junio' => 6,
                            'julio' => 7, 'agosto' => 8, 'septiembre' => 9,
                            'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12
                        ];

                        $mes_numero = $meses[strtolower($mes)];

                        // Crea una fecha en formato YYYY-MM-DD
                        $fecha_formateada = DateTime::createFromFormat('Y-n-j', "$año-$mes_numero-$dia");
                        $fecha_faltante =$fecha_formateada->format('Y-m-d') ;


                        $fecha_formateada = DateTime::createFromFormat('Y-m-d', $fecha_faltante); // Ejemplo con 2024-11-13
                        $dia_semana_en = $fecha_formateada->format('l');
                        $dias_semana = [
                            'Monday' => 'Lunes',
                            'Tuesday' => 'Martes',
                            'Wednesday' => 'Miércoles',
                            'Thursday' => 'Jueves',
                            'Friday' => 'Viernes',
                            'Saturday' => 'Sábado',
                            'Sunday' => 'Domingo'
                        ];

                        $dia_semana_es = $dias_semana[$dia_semana_en];


                        $falta_descanso = 
                        DB::connection('mysql')->select('SELECT * from t_horarios_enrolador_personal where id_empleado='.$idElemento.' 
                        and "'.$fecha_faltante.'" between fecha_inicio and fecha_fin and estatus ="Inactivo"');

                        if(count($falta_descanso) == 0)
                        {
                            $falta_descanso = 
                            DB::connection('mysql')->select('SELECT * from t_horarios_enrolador_personal where id_empleado='.$idElemento.' 
                            and "'.$fecha_faltante.'" > fecha_inicio and estatus ="Activo"');
                        }

                        //dd( $falta_descanso ); 
                        if(count($falta_descanso)>0)
                        {
                            $id_horario = $falta_descanso[0]->id_horario;
                            $rol_horario = 
                            DB::connection('mysql')->select('SELECT * from t_horarios_personal where id_t_horarios_personal='.$id_horario.' ');
                            //dd($rol_horario);
                            
                            if($dia_semana_es == 'Lunes')
                            {
                                if($rol_horario[0]->jornada_l == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Martes')
                            {
                                if($rol_horario[0]->jornada_m == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Miércoles')
                            {
                                if($rol_horario[0]->jornada_mi == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Jueves')
                            {
                                if($rol_horario[0]->jornada_j == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Viernes')
                            {
                                if($rol_horario[0]->jornada_v == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Sábado')
                            {
                                if($rol_horario[0]->jornada_s == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Domingo')
                            {
                                
                                if($rol_horario[0]->jornada_d == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = ' Falta';
                                }
                            }

                            $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];

                        }else{
                            $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];
                            $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Sin rol';
                            $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Sin rol';
                            $acomodado[$idElemento][$j]['id_horario'] = '0';
                        }

                        
                        
                    }
                }
            }
            else
            {
                // Si no existe el índice $idElemento, ejecuta el bloque else
                for ($j = 0; count($fechas_formateadas) > $j; $j++) 
                {
                    
                        // Crea una nueva entrada en el array $acomodado para el elemento $idElemento
                        $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];
                        $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Sin rol';
                        $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Sin rol';
                        $acomodado[$idElemento][$j]['id_horario'] = '0';
            
                   
                }
        
            }
        }
        
        
       //dd($acomodado[2900]); // Muestra el resultado para depuración
       
       date_default_timezone_set('America/Mexico_City');
       $hora_actual = time();            
       $hora_formateada = date('Y-m-d H:i:s', $hora_actual);

        return Excel::download(new BiometricoExport2($acomodado,$elementos,$fechas_formateadas), 'biometrico '.$hora_formateada.'.xlsx');
       
            
        }


        $id_ele="-Selecciona-";
        $consulta="";
        $fecha_fin=null;
        $fecha_inicio=null;
        $jornadas = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal ');
        $fechas_qna = DB::connection('mysql')->select(
            'SELECT DISTINCT DATE(fecha_hora) AS fecha
            FROM t_biometrico
            WHERE fecha_hora BETWEEN '.$qna.' order by fecha asc;'
        );
        $elementos = DB::connection('mysql')->select(
            'SELECT DISTINCT id_elemento FROM t_biometrico where id_elemento!="" and fecha_hora between '.$qna.' ORDER BY id_elemento asc;'
        );
        //dd($fechas_qna);
        return view('Transmasivo.rh.consultar_biometrico2',compact('jornadas','array_completo','fechas_qna','qna','consulta','elementos','id_ele','fecha_fin','fecha_inicio'));

    }
    function aumentarUnDia($fecha) {
        $date = new DateTime($fecha);
        $date->modify('+1 day'); // Aumenta un día
        return $date->format('Y-m-d'); // Retorna en formato 'YYYY-MM-DD'
    }
    public function validaestatusS($hora_llegada_real, $hora_llegada_jornada)
    {
        if($hora_llegada_real>$hora_llegada_jornada){
            return 'Salio bien';
        }else {
            return 'Salio antes';
        }
    }

    public function validaestatus($hora_llegada_real, $hora_llegada_jornada)
    {
        if($hora_llegada_real>$hora_llegada_jornada){
            return 'Llego tarde';
        }else {
            return 'Llego bien';
        }
    }
    public function calcular_diferencia ($real,$jornada)
    {
        $hora_llegada_real = new DateTime($real);
        $hora_llegada_jornada = new DateTime($jornada);

        $diferencia = $hora_llegada_real->diff($hora_llegada_jornada);

        $horas = $diferencia->h;
        $minutos = $diferencia->i;
        $segundos = $diferencia->s;

        // Si la diferencia cruza días, incluir el total de horas considerando días
        $total_horas = $diferencia->days * 24 + $horas;
        if($total_horas==0 ||$total_horas==1 ||$total_horas==2 ||$total_horas==3 ||$total_horas==4 ||$total_horas==5 
            ||$total_horas==6 ||$total_horas==7 ||$total_horas==8 || $total_horas==9  )
        {
            $total_horas = '0'.$total_horas;
        }
        if($minutos==0 ||$minutos==1 ||$minutos==2 ||$minutos==3 ||$minutos==4 ||$minutos==5 
            ||$minutos==6 ||$minutos==7 ||$minutos==8 || $minutos==9  )
        {
            $minutos = '0'.$minutos;
        }
        if($segundos==0 ||$segundos==1 ||$segundos==2 ||$segundos==3 ||$segundos==4 ||$segundos==5 
            ||$segundos==6 ||$segundos==7 ||$segundos==8 || $segundos==9  )
        {
            $segundos = '0'.$segundos;
        }
        return $total_horas.':'.$minutos.':'.$segundos;

    }
    
    public function consulta_t_biometrico_doble_dia($elemento, $fecha, $menor_mayor)
    {
        return DB::connection('mysql')->select(
            'SELECT * FROM t_biometrico where id_elemento='.$elemento.' and 
            fecha_hora between "'.$fecha.' 00:00:00" and "'.$fecha.' 23:59:59"  order by fecha_hora '.$menor_mayor
        );
    }
    public function consulta_t_biometrico($elemento, $fecha, $menor_mayor)
    {
        return DB::connection('mysql')->select(
            'SELECT * FROM t_biometrico where id_elemento='.$elemento.' and 
            fecha_hora between "'.$fecha.' 00:00:00" and "'.$fecha.' 23:59:59"  order by fecha_hora '.$menor_mayor
        );
    }
    public function post_consultar_biometrico(Request $request)
    {
        if($request->has('Consultar'))
        {
            $id_empleado=$request->input('id_empleado');
            $qna=$request->input('qna');
            $fecha_inicio=$request->input('fecha_inicio').' 00:00:00';
            $fecha_fin=$request->input('fecha_fin').' 23:59:59';
            
            $id_ele=$id_empleado;
            $consulta;

            $where = "";
            $where2 = "";

            if($qna !== "-Selecciona-")
            {
                $where .= " WHERE  fecha_hora BETWEEN ".$qna." ";
            }

            if($id_empleado !== "-Selecciona-")
            {
                $where2 .= "    and   e.id_empleado = ". $id_empleado. " ";
            }


            $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
            $español = DB::connection('mysql')->select("SET lc_time_names = 'es_ES';");
            $consulta = DB::connection('mysql')->select("SELECT 
            e.id_empleado,
            h.nombre_horario,
            b.fecha_hora AS registro_biometrico,
            CASE 
                WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN 'Domingo'
                WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN 'Lunes'
                WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN 'Martes'
                WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN 'Miércoles'
                WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN 'Jueves'
                WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN 'Viernes'
                WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN 'Sábado'
            END AS dia_registro,
            DATE_FORMAT(b.fecha_hora, '%W, %e de %M del %Y') AS fecha_formato_largo,
            CASE 
                WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
                WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
                WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
                WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
                WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
                WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
                WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
            END AS hora_esperada_llegada,
            CASE 
                WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
                WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
                WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
                WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
                WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
                WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
                WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
            END AS hora_esperada_salida,
    TIMEDIFF(
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END
) AS horas_trabajo_esperadas,
            CASE 
                WHEN TIME(b.fecha_hora) <= CASE 
                    WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
                    WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
                    WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
                    WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
                    WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
                    WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
                    WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
                END THEN 'A tiempo'
                ELSE 'Tarde'
            END AS estado_llegada,
            TIMEDIFF(
                (SELECT MAX(fecha_hora)
                 FROM t_biometrico
                 WHERE id_elemento = b.id_elemento 
                   AND DATE(fecha_hora) = DATE(b.fecha_hora)),
                b.fecha_hora
            ) AS tiempo_trabajado,
            CASE 
                WHEN TIME((SELECT MAX(fecha_hora)
             FROM t_biometrico
             WHERE id_elemento = b.id_elemento 
               AND DATE(fecha_hora) = DATE(b.fecha_hora))) >= CASE 
                    WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
                    WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
                    WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
                    WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
                    WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
                    WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
                    WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
                END THEN 'A tiempo'
                ELSE 'Salio antes'
            END AS estado_salida,
            (SELECT MAX(fecha_hora)
             FROM t_biometrico
             WHERE id_elemento = b.id_elemento 
               AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS ultimo_registro_biometrico,
            (SELECT GROUP_CONCAT(DISTINCT fecha_hora ORDER BY fecha_hora SEPARATOR ',<br> ')
             FROM t_biometrico
             WHERE id_elemento = b.id_elemento 
               AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS todos_registros_dia,
                (SELECT COUNT(DISTINCT fecha_hora)
 FROM t_biometrico
 WHERE id_elemento = b.id_elemento 
   AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS conteo_todos_registros_dia


        FROM 
            t_horarios_enrolador_personal e
        JOIN 
            t_horarios_personal h ON e.id_horario = h.id_t_horarios_personal
        JOIN 
            (
                SELECT 
                    id_elemento, 
                    MIN(fecha_hora) AS fecha_hora
                FROM 
                    t_biometrico
                ".$where."
                GROUP BY 
                    id_elemento, DATE(fecha_hora)
            ) b ON e.id_empleado = b.id_elemento
        WHERE 
            (e.fecha_inicio IS NULL OR e.fecha_inicio <= b.fecha_hora) 
            AND (e.fecha_fin IS NULL OR e.fecha_fin >= b.fecha_hora)
            ".$where2."
        ORDER BY 
            h.nombre_horario, e.id_empleado, b.fecha_hora ASC;
        ");
       // dd($consulta);

            Carbon::setLocale('es');
           // $consulta = DB::connection('mysql')->select($consulta_sql);
       
        // Suponiendo que $consulta es tu colección de datos
            
            
       
        $jornadas = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal ');
            $fecha_inicio=$request->input('fecha_inicio');
            $fecha_fin=$request->input('fecha_fin');
            return view('Transmasivo.rh.consultar_biometrico',compact('jornadas','qna','consulta','elementos','id_ele','fecha_fin','fecha_inicio'));
        }else if($request->has('Excel')){
           
            $id_empleado=$request->input('id_empleado');
            $qna=$request->input('qna');
            $fecha_inicio=$request->input('fecha_inicio').' 00:00:00';
            $fecha_fin=$request->input('fecha_fin').' 23:59:59';
            
            $id_ele=$id_empleado;
            $consulta;

            $where = "";
            $where2 = "";

            if($qna !== "-Selecciona-")
            {
                $where .= " WHERE  fecha_hora BETWEEN ".$qna." ";
            }

            if($id_empleado !== "-Selecciona-")
            {
                $where2 .= "    and   e.id_empleado = ". $id_empleado. " ";
            }


            $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
            $español = DB::connection('mysql')->select("SET lc_time_names = 'es_ES';");
            $consulta = DB::connection('mysql')->select("SELECT 
    e.id_empleado,
    h.nombre_horario,
    b.fecha_hora AS registro_biometrico,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN 'Domingo'
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN 'Lunes'
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN 'Martes'
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN 'Miércoles'
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN 'Jueves'
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN 'Viernes'
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN 'Sábado'
    END AS dia_registro,
    DATE_FORMAT(b.fecha_hora, '%W, %e de %M del %Y') AS fecha_formato_largo,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END AS hora_esperada_llegada,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END AS hora_esperada_salida,
    TIMEDIFF(
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END
) AS horas_trabajo_esperadas,
    CASE 
        WHEN TIME(b.fecha_hora) <= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Tarde'
    END AS estado_llegada,
    TIMEDIFF(
        (SELECT MAX(fecha_hora)
         FROM t_biometrico
         WHERE id_elemento = b.id_elemento 
           AND DATE(fecha_hora) = DATE(b.fecha_hora)),
        b.fecha_hora
    ) AS tiempo_trabajado,
    CASE 
        WHEN TIME((SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora))) >= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Salio antes'
    END AS estado_salida,
    (SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS ultimo_registro_biometrico,
    (SELECT GROUP_CONCAT(DISTINCT fecha_hora ORDER BY fecha_hora SEPARATOR ',<br> ')
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS todos_registros_dia,
    (SELECT COUNT(DISTINCT fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS conteo_todos_registros_dia

FROM 
    t_horarios_enrolador_personal e
JOIN 
    t_horarios_personal h ON e.id_horario = h.id_t_horarios_personal
JOIN 
    (
        SELECT 
            id_elemento, 
            MIN(fecha_hora) AS fecha_hora
        FROM 
            t_biometrico
        ".$where."
        GROUP BY 
            id_elemento, DATE(fecha_hora)
    ) b ON e.id_empleado = b.id_elemento
WHERE 
    (e.fecha_inicio IS NULL OR e.fecha_inicio <= b.fecha_hora) 
    AND (e.fecha_fin IS NULL OR e.fecha_fin >= b.fecha_hora)
    ".$where2."
ORDER BY 
    h.nombre_horario, e.id_empleado, b.fecha_hora ASC;
");

      //  dd($consulta);

            Carbon::setLocale('es');
           // $consulta = DB::connection('mysql')->select($consulta_sql);
       
        // Suponiendo que $consulta es tu colección de datos
            
            
       
        $jornadas = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal ');
            $fecha_inicio=$request->input('fecha_inicio');
            $fecha_fin=$request->input('fecha_fin');
            
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();            
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);

        
        


// Separar las fechas de inicio y fin
list($fechaInicio, $fechaFin) = explode(' AND ', $qna);
list($fechaInicio) = explode(' 00:00:00', $fechaInicio);
list($fechaInicio) = explode("''", $fechaInicio);
list($fechaFin) = explode(' 23:59:59', $fechaFin);

$fechaInicio = $fechaInicio."'";
$fechaFin = $fechaFin."'";

// Construir la consulta utilizando las fechas de $qna
$query = "
    WITH RECURSIVE rango_fechas AS (
        SELECT DATE($fechaInicio) AS fecha
        UNION ALL
        SELECT DATE_ADD(fecha, INTERVAL 1 DAY)
        FROM rango_fechas
        WHERE fecha < DATE($fechaFin)
    )
    SELECT fecha
    FROM rango_fechas;
";

// Ejecutar la consulta (esto depende de cómo manejas tus consultas)
$resultados = DB::select($query);

$fechas_formateadas = [];

$dias_semana = [
    'Monday' => 'lunes',
    'Tuesday' => 'martes',
    'Wednesday' => 'miércoles',
    'Thursday' => 'jueves',
    'Friday' => 'viernes',
    'Saturday' => 'sábado',
    'Sunday' => 'domingo'
];

$meses = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

foreach ($resultados as $resultado) {
    // Convertir la fecha a un objeto DateTime
    $fecha = new DateTime($resultado->fecha);

    // Obtener el día de la semana, día del mes, mes y año
    $dia_semana = $dias_semana[$fecha->format('l')];
    $dia = $fecha->format('j');
    $mes = $meses[$fecha->format('F')];
    $año = $fecha->format('Y');

    // Construir la fecha en el formato deseado
    $fechas_formateadas[] = "$dia_semana, $dia de $mes del $año";
}




$agrupadosPorEmpleado = [];

// Paso 1: Agrupar los registros de $consulta por id_empleado
foreach ($consulta as $registro) {
    $idEmpleado = $registro->id_empleado;
    
    if (!isset($agrupadosPorEmpleado[$idEmpleado])) {
        $agrupadosPorEmpleado[$idEmpleado] = [
            'nombre_horario' => $registro->nombre_horario,
            'registros' => []
        ];
    }

    // Convertir fecha_formato_largo a formato de fecha numérica para ordenamiento
    $fechaOriginal = $registro->fecha_formato_largo;
    $fechaConvertida = DateTime::createFromFormat('l, j \d\e F \d\e\l Y', $fechaOriginal);
    
    if ($fechaConvertida) {
        $fechaOrdenable = $fechaConvertida->format('Y-m-d');
        // Extraer el día del mes para ordenar
        $diaDelMes = (int)$fechaConvertida->format('d');
    } else {
        // Si la conversión falla, usar la fecha original como clave (aunque no es ideal)
        $fechaOrdenable = $fechaOriginal;
        $diaDelMes = 0; // Un valor arbitrario para manejar la fecha inválida
    }

    // Añadir la información de fecha_formato_largo y tiempo_trabajado al array de registros del empleado
    $agrupadosPorEmpleado[$idEmpleado]['registros'][] = [
        'fecha_ordenable' => $fechaOrdenable,
        'fecha_mostrada' => $fechaOriginal,
        'tiempo_trabajado' => $registro->tiempo_trabajado,
        'estado_llegada' => $registro->estado_llegada,
        'estado_salida' => $registro->estado_salida,
        'dia_del_mes' => $diaDelMes, // Guardamos el número del día para ordenar
    ];
}

// Paso 2: Generar el rango completo de fechas
$fechasCompletas = [];
foreach ($fechas_formateadas as $fecha) {
    // Convertir fecha formateada a formato ordenable
    $fechaConvertida = DateTime::createFromFormat('l, j \d\e F \d\e\l Y', $fecha);
    $fechaOrdenable = $fechaConvertida ? $fechaConvertida->format('Y-m-d') : $fecha;
    
    // Extraer el día del mes para ordenar
    $diaDelMes = $fechaConvertida ? (int)$fechaConvertida->format('d') : 0;
    
    // Añadir al array de fechas completas
    $fechasCompletas[] = [
        'fecha_ordenable' => $fechaOrdenable,
        'fecha_mostrada' => $fecha,
        'tiempo_trabajado' => 'Falta', // "Falta" si no se encuentra en los registros
        'estado_llegada' => 'Falta',
        'estado_salida' => 'Falta',
        'dia_del_mes' => $diaDelMes, // Guardamos el número del día para ordenar
    ];
}

// Paso 3: Mezclar los registros con las fechas faltantes
foreach ($agrupadosPorEmpleado as $idEmpleado => &$datosEmpleado) {
    // Unir las fechas faltantes con los registros existentes
    foreach ($fechasCompletas as $fechaFalta) {
        $fechaFaltaOrdenable = $fechaFalta['fecha_ordenable'];
        $existeFecha = false;
        
        // Comprobar si la fecha falta ya existe en los registros del empleado
        foreach ($datosEmpleado['registros'] as $registro) {
            if ($registro['fecha_ordenable'] === $fechaFaltaOrdenable) {
                $existeFecha = true;
                break;
            }
        }
        
        // Si no existe en los registros, añadirla como "falta"
        if (!$existeFecha) {
            $datosEmpleado['registros'][] = $fechaFalta;
        }
    }
    
    // Paso 4: Ordenar los registros por el día del mes (dia_del_mes)
    usort($datosEmpleado['registros'], function ($a, $b) {
        return $a['dia_del_mes'] - $b['dia_del_mes']; // Comparar los días del mes
    });
}



//dd($agrupadosPorEmpleado);
// Mostrar resultados



            return Excel::download(new BiometricoExport($consulta,$agrupadosPorEmpleado,$fechas_formateadas), 'biometrico '.$hora_formateada.'.xlsx');
            
        }else if($request->has('Excel2')){
           
            $id_empleado=$request->input('id_empleado');
            $qna=$request->input('qna');
            $fecha_inicio=$request->input('fecha_inicio').' 00:00:00';
            $fecha_fin=$request->input('fecha_fin').' 23:59:59';
            
            $id_ele=$id_empleado;
            $consulta;

            $where = "";
            $where2 = "";

            if($qna !== "-Selecciona-")
            {
                $where .= " WHERE  fecha_hora BETWEEN ".$qna." ";
            }

            if($id_empleado !== "-Selecciona-")
            {
                $where2 .= "    and   e.id_empleado = ". $id_empleado. " ";
            }


            $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
            $español = DB::connection('mysql')->select("SET lc_time_names = 'es_ES';");
            $consulta = DB::connection('mysql')->select("SELECT 
    e.id_empleado,
    h.nombre_horario,
    h.id_t_horarios_personal,
    b.fecha_hora AS registro_biometrico,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN 'Domingo'
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN 'Lunes'
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN 'Martes'
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN 'Miércoles'
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN 'Jueves'
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN 'Viernes'
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN 'Sábado'
    END AS dia_registro,
    DATE_FORMAT(b.fecha_hora, '%W, %e de %M del %Y') AS fecha_formato_largo,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END AS hora_esperada_llegada,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END AS hora_esperada_salida,
    TIMEDIFF(
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
    END,
    CASE 
        WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
        WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
        WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
        WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
        WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
        WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
        WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
    END
) AS horas_trabajo_esperadas,
    CASE 
        WHEN TIME(b.fecha_hora) <= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_llegada_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_llegada_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_llegada_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_llegada_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_llegada_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_llegada_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_llegada_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Tarde'
    END AS estado_llegada,
    TIMEDIFF(
        (SELECT MAX(fecha_hora)
         FROM t_biometrico
         WHERE id_elemento = b.id_elemento 
           AND DATE(fecha_hora) = DATE(b.fecha_hora)),
        b.fecha_hora
    ) AS tiempo_trabajado,
    CASE 
        WHEN TIME((SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora))) >= CASE 
            WHEN DAYOFWEEK(b.fecha_hora) = 2 THEN h.hora_salida_l -- Lunes
            WHEN DAYOFWEEK(b.fecha_hora) = 3 THEN h.hora_salida_m -- Martes
            WHEN DAYOFWEEK(b.fecha_hora) = 4 THEN h.hora_salida_mi -- Miércoles
            WHEN DAYOFWEEK(b.fecha_hora) = 5 THEN h.hora_salida_j -- Jueves
            WHEN DAYOFWEEK(b.fecha_hora) = 6 THEN h.hora_salida_v -- Viernes
            WHEN DAYOFWEEK(b.fecha_hora) = 7 THEN h.hora_salida_s -- Sábado
            WHEN DAYOFWEEK(b.fecha_hora) = 1 THEN h.hora_salida_d -- Domingo
        END THEN 'A tiempo'
        ELSE 'Salio antes'
    END AS estado_salida,
    (SELECT MAX(fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS ultimo_registro_biometrico,
    (SELECT GROUP_CONCAT(DISTINCT fecha_hora ORDER BY fecha_hora SEPARATOR ',<br> ')
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS todos_registros_dia,
    (SELECT COUNT(DISTINCT fecha_hora)
     FROM t_biometrico
     WHERE id_elemento = b.id_elemento 
       AND DATE(fecha_hora) = DATE(b.fecha_hora)) AS conteo_todos_registros_dia

FROM 
    t_horarios_enrolador_personal e
JOIN 
    t_horarios_personal h ON e.id_horario = h.id_t_horarios_personal
JOIN 
    (
        SELECT 
            id_elemento, 
            MIN(fecha_hora) AS fecha_hora
        FROM 
            t_biometrico
        ".$where."
        GROUP BY 
            id_elemento, DATE(fecha_hora)
    ) b ON e.id_empleado = b.id_elemento
WHERE 
    (e.fecha_inicio IS NULL OR e.fecha_inicio <= b.fecha_hora) 
    AND (e.fecha_fin IS NULL OR e.fecha_fin >= b.fecha_hora)
    ".$where2."
ORDER BY 
    h.nombre_horario, e.id_empleado, b.fecha_hora ASC;
");


//dd($consulta);
// Separar las fechas de inicio y fin
list($fechaInicio, $fechaFin) = explode(' AND ', $qna);
list($fechaInicio) = explode(' 00:00:00', $fechaInicio);
list($fechaInicio) = explode("''", $fechaInicio);
list($fechaFin) = explode(' 23:59:59', $fechaFin);

$fechaInicio = $fechaInicio."'";
$fechaFin = $fechaFin."'";

// Construir la consulta utilizando las fechas de $qna
$query = "
    WITH RECURSIVE rango_fechas AS (
        SELECT DATE($fechaInicio) AS fecha
        UNION ALL
        SELECT DATE_ADD(fecha, INTERVAL 1 DAY)
        FROM rango_fechas
        WHERE fecha < DATE($fechaFin)
    )
    SELECT fecha
    FROM rango_fechas;
";

// Ejecutar la consulta (esto depende de cómo manejas tus consultas)
$resultados = DB::select($query);

$fechas_formateadas = [];

$dias_semana = [
    'Monday' => 'lunes',
    'Tuesday' => 'martes',
    'Wednesday' => 'miércoles',
    'Thursday' => 'jueves',
    'Friday' => 'viernes',
    'Saturday' => 'sábado',
    'Sunday' => 'domingo'
];

$meses = [
    'January' => 'enero',
    'February' => 'febrero',
    'March' => 'marzo',
    'April' => 'abril',
    'May' => 'mayo',
    'June' => 'junio',
    'July' => 'julio',
    'August' => 'agosto',
    'September' => 'septiembre',
    'October' => 'octubre',
    'November' => 'noviembre',
    'December' => 'diciembre'
];

foreach ($resultados as $resultado) {
    // Convertir la fecha a un objeto DateTime
    $fecha = new DateTime($resultado->fecha);

    // Obtener el día de la semana, día del mes, mes y año
    $dia_semana = $dias_semana[$fecha->format('l')];
    $dia = $fecha->format('j');
    $mes = $meses[$fecha->format('F')];
    $año = $fecha->format('Y');

    // Construir la fecha en el formato deseado
    $fechas_formateadas[] = "$dia_semana, $dia de $mes del $año";
}


       $acomodado = []; // Inicializa un array vacío

       for ($i = 0; count($consulta) > $i; $i++) 
       {
            for ($j = 0; count($fechas_formateadas) > $j; $j++) 
            {
                if($fechas_formateadas[$j] == $consulta[$i]->fecha_formato_largo)
                {
                    
                    $acomodado[$consulta[$i]->id_empleado][$j]['fecha_formato_largo'] = $consulta[$i]->fecha_formato_largo;
                    $acomodado[$consulta[$i]->id_empleado][$j]['horas_trabajo_esperadas'] = $consulta[$i]->horas_trabajo_esperadas;
                    $acomodado[$consulta[$i]->id_empleado][$j]['tiempo_trabajado'] = $consulta[$i]->tiempo_trabajado;
                    $acomodado[$consulta[$i]->id_empleado][$j]['id_horario'] = $consulta[$i]->id_t_horarios_personal;
                }
       
            }
        }

        $usuarios_registro = DB::connection('mysql')->select('SELECT distinct(id_elemento) FROM t_biometrico '.$where.' ORDER BY id_elemento ASC');
        //lista de todos los usuarios


       //dd($acomodado[2984]);
        
        for ($i = 0; count($usuarios_registro) > $i; $i++) 
        {
            $idElemento = $usuarios_registro[$i]->id_elemento; // Obtiene el id_elemento actual
            
            // Verifica si el índice $idElemento ya existe en el array $acomodado
            if (isset($acomodado[$idElemento]))
            {
                for ($j = 0; count($fechas_formateadas) > $j; $j++) 
                {
                    
                    if (isset($acomodado[$idElemento][$j]))
                    {
                    }else{

                        //fechas que no existen registrar si fue descanso o falta
                        $fecha_texto = $fechas_formateadas[$j]; 
                        preg_match('/(\d{1,2}) de (\w+) del (\d{4})/', $fecha_texto, $matches);

                        $dia = $matches[1];
                        $mes = $matches[2];
                        $año = $matches[3];

                        // Mapea los meses en español a números
                        $meses = [
                            'enero' => 1, 'febrero' => 2, 'marzo' => 3,
                            'abril' => 4, 'mayo' => 5, 'junio' => 6,
                            'julio' => 7, 'agosto' => 8, 'septiembre' => 9,
                            'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12
                        ];

                        $mes_numero = $meses[strtolower($mes)];

                        // Crea una fecha en formato YYYY-MM-DD
                        $fecha_formateada = DateTime::createFromFormat('Y-n-j', "$año-$mes_numero-$dia");
                        $fecha_faltante =$fecha_formateada->format('Y-m-d') ;


                        $fecha_formateada = DateTime::createFromFormat('Y-m-d', $fecha_faltante); // Ejemplo con 2024-11-13
                        $dia_semana_en = $fecha_formateada->format('l');
                        $dias_semana = [
                            'Monday' => 'Lunes',
                            'Tuesday' => 'Martes',
                            'Wednesday' => 'Miércoles',
                            'Thursday' => 'Jueves',
                            'Friday' => 'Viernes',
                            'Saturday' => 'Sábado',
                            'Sunday' => 'Domingo'
                        ];

                        $dia_semana_es = $dias_semana[$dia_semana_en];


                        $falta_descanso = 
                        DB::connection('mysql')->select('SELECT * from t_horarios_enrolador_personal where id_empleado='.$idElemento.' 
                        and "'.$fecha_faltante.'" between fecha_inicio and fecha_fin and estatus ="Inactivo"');

                        if(count($falta_descanso) == 0)
                        {
                            $falta_descanso = 
                            DB::connection('mysql')->select('SELECT * from t_horarios_enrolador_personal where id_empleado='.$idElemento.' 
                            and "'.$fecha_faltante.'" > fecha_inicio and estatus ="Activo"');
                        }

                        //dd( $falta_descanso ); 
                        if(count($falta_descanso)>0)
                        {
                            $id_horario = $falta_descanso[0]->id_horario;
                            $rol_horario = 
                            DB::connection('mysql')->select('SELECT * from t_horarios_personal where id_t_horarios_personal='.$id_horario.' ');
                            //dd($rol_horario);
                            
                            if($dia_semana_es == 'Lunes')
                            {
                                if($rol_horario[0]->jornada_l == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Martes')
                            {
                                if($rol_horario[0]->jornada_m == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Miércoles')
                            {
                                if($rol_horario[0]->jornada_mi == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Jueves')
                            {
                                if($rol_horario[0]->jornada_j == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Viernes')
                            {
                                if($rol_horario[0]->jornada_v == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Sábado')
                            {
                                if($rol_horario[0]->jornada_s == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Falta';
                                }

                            }
                            if($dia_semana_es == 'Domingo')
                            {
                                
                                if($rol_horario[0]->jornada_d == "Descanso"){
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Descanso';
                                    $acomodado[$idElemento][$j]['id_horario'] = 'Descanso';
                                }else{
                                    $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Falta';
                                    $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Falta';
                                    $acomodado[$idElemento][$j]['id_horario'] = ' Falta';
                                }
                            }

                            $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];

                        }else{
                            $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];
                            $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Sin rol';
                            $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Sin rol';
                            $acomodado[$idElemento][$j]['id_horario'] = '0';
                        }

                        
                        
                    }
                }
            }
            else
            {
                // Si no existe el índice $idElemento, ejecuta el bloque else
                for ($j = 0; count($fechas_formateadas) > $j; $j++) 
                {
                    
                        // Crea una nueva entrada en el array $acomodado para el elemento $idElemento
                        $acomodado[$idElemento][$j]['fecha_formato_largo'] = $fechas_formateadas[$j];
                        $acomodado[$idElemento][$j]['horas_trabajo_esperadas'] = 'Sin rol';
                        $acomodado[$idElemento][$j]['tiempo_trabajado'] = 'Sin rol';
                        $acomodado[$idElemento][$j]['id_horario'] = '0';
            
                   
                }
        
            }
        }
        
        
       //dd($acomodado[2900]); // Muestra el resultado para depuración
       
       date_default_timezone_set('America/Mexico_City');
       $hora_actual = time();            
       $hora_formateada = date('Y-m-d H:i:s', $hora_actual);

        return Excel::download(new BiometricoExport2($acomodado,$elementos,$fechas_formateadas), 'biometrico '.$hora_formateada.'.xlsx');
       
            
        }
        
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
        
        $consulta="";
        $where="";
        
        return view('Transmasivo.rh.Consultar_biometricos_usuario',compact('consulta','where'));
        
    }
    public function postConsultar_biometricos_usuario(Request $request)
    {
        if ($request->has('Descargar'))
        {
            $id = auth()->user()->id; 
            $qna=$request->input('Descargar');
            
            $consulta;
            $consulta_sql="SELECT 
    id_elemento,
    DATE(fecha_hora) AS dia, 
    MIN(fecha_hora) AS inicio,
    MAX(fecha_hora) AS fin,
    TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
    CASE 
        WHEN (
            SELECT 
                thp.hora_llegada 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) IS NULL THEN 'Usuario sin horario'
        WHEN TIME(MIN(fecha_hora)) > (
            SELECT 
                thp.hora_llegada 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) THEN 'Retardo'
        ELSE 'En tiempo'
    END AS estado,
    CASE 
        WHEN (
            SELECT 
                thp.hora_salida 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) IS NULL THEN 'Usuario sin horario'
        WHEN TIME(MAX(fecha_hora)) < (
            SELECT 
                thp.hora_salida 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) THEN 'Salió antes'
        ELSE 'Salió bien'
    END AS salida_estado,
    GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR ', ') AS todas_las_fechas
FROM 
    t_biometrico WHERE ";
                $consulta_sql.=" id_elemento=".$id." and ";
                if($qna!="-Selecciona-" ){
                    $consulta_sql.=" fecha_hora BETWEEN  ".$qna."  and ";
                }
            $consulta_sql.=" id_elemento > 0 ";
            $consulta_sql.="GROUP BY id_elemento, dia;";
            Carbon::setLocale('es');
            $consulta = DB::connection('mysql')->select($consulta_sql);
    
            foreach($consulta as $consul) {
                $fechas_html = str_replace('<hr>', ',', $consul->todas_las_fechas);
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    $fecha_form = Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
                    return $fecha_form.' hrs.';
                }, $fechas_unicas);
                
               
                $consul->todas_las_fechas = implode('<br>', $fechas_formateadas);
            }
            foreach($consulta as $consul) {
                $fechas_html = $consul->inicio;
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    return Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
                }, $fechas_unicas);
                $consul->inicio =  $fechas_formateadas;
            }
            foreach($consulta as $consul) {
                $fechas_html =  $consul->fin;
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    return Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
                }, $fechas_unicas);
                $consul->fin = $fechas_formateadas;
            }
            foreach($consulta as $consul) {
                $fechas_html =  $consul->dia;
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    return Carbon::parse($fecha)->translatedFormat(' D d  M  Y ');
                }, $fechas_unicas);
                $consul->dia = $fechas_formateadas;
            }
            
            //DD($consulta);
            $html = view('Transmasivo.rh.pdf_Consultar_biometricos_usuario', compact('consulta'))->render();
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('Carta'); 
            $dompdf->render();
            return $dompdf->stream($id.'_'.$request->input('Descargar').'.pdf');

        }else{
            $id = auth()->user()->id; 
            $qna=$request->input('qna');
            
            $consulta;
            $consulta_sql="SELECT 
    id_elemento,
    DATE(fecha_hora) AS dia, 
    MIN(fecha_hora) AS inicio,
    MAX(fecha_hora) AS fin,
    TIMEDIFF(MAX(fecha_hora), MIN(fecha_hora)) AS tiempo_trabajado,
    CASE 
        WHEN (
            SELECT 
                thp.hora_llegada 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) IS NULL THEN 'Usuario sin horario'
        WHEN TIME(MIN(fecha_hora)) > (
            SELECT 
                thp.hora_llegada 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) THEN 'Retardo'
        ELSE 'En tiempo'
    END AS estado,
    CASE 
        WHEN (
            SELECT 
                thp.hora_salida 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) IS NULL THEN 'Usuario sin horario'
        WHEN TIME(MAX(fecha_hora)) < (
            SELECT 
                thp.hora_salida 
            FROM 
                t_horarios_enrolador_personal tehp
            INNER JOIN 
                t_horarios_personal thp 
            ON 
                thp.id_t_horarios_personal = tehp.id_horario 
            WHERE 
                tehp.id_empleado = id_elemento 
                AND tehp.estatus = 'Activo'
            LIMIT 1
        ) THEN 'Salió antes'
        ELSE 'Salió bien'
    END AS salida_estado,
    GROUP_CONCAT(fecha_hora ORDER BY fecha_hora ASC SEPARATOR ', ') AS todas_las_fechas
FROM 
    t_biometrico WHERE ";
                $consulta_sql.=" id_elemento=".$id." and ";
            if($qna!="-Selecciona-" ){
                $consulta_sql.=" fecha_hora BETWEEN  ".$qna."  and ";
            }
            $consulta_sql.=" id_elemento > 0 ";
            $consulta_sql.="GROUP BY id_elemento, dia;";
            Carbon::setLocale('es');
            $consulta = DB::connection('mysql')->select($consulta_sql);
    
            foreach($consulta as $consul) {
                $fechas_html = str_replace('<hr>', ',', $consul->todas_las_fechas);
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    return Carbon::parse($fecha)->translatedFormat(' D d  M  Y H:i:s');
                }, $fechas_unicas);
                $consul->todas_las_fechas = implode('<hr>', $fechas_formateadas);
            }
            foreach($consulta as $consul) {
                $fechas_html =  $consul->dia;
                $fechas = explode(',', $fechas_html);
                $fechas = array_map('trim', $fechas);
                $fechas_unicas = array_unique($fechas);
                $fechas_unicas = array_filter($fechas_unicas, fn($fecha) => !empty($fecha));
                $fechas_formateadas = array_map(function($fecha) {
                    return Carbon::parse($fecha)->translatedFormat(' D d  M  Y ');
                }, $fechas_unicas);
                $consul->dia = $fechas_formateadas;
            }
            $where=$qna;
            
            return view('Transmasivo.rh.Consultar_biometricos_usuario',compact('consulta','where'));
        }
       
        
    }

    public function Enrolar_horarios()
    {
        $elementos = DB::connection('mysql')->select('SELECT DISTINCT id_elemento FROM t_biometrico ORDER BY id_elemento asc;');
        
        $consulta = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal where estatus="Activo" ORDER BY nombre_horario asc;');
        $consulta_tabla = DB::connection('mysql')->select('SELECT * from t_horarios_enrolador_personal
            INNER JOIN t_horarios_personal ON t_horarios_personal.id_t_horarios_personal=t_horarios_enrolador_personal.id_horario 
            left JOIN users ON users.id=t_horarios_enrolador_personal.id_empleado 
            WHERE t_horarios_enrolador_personal.estatus="Activo"');

        $id_ele="";
        return view('Transmasivo.rh.Enrolar_horarios',compact('elementos','id_ele','consulta','consulta_tabla'));
    }
    public function post_Enrolar_horarios(Request $request)
    {
        $id_empleado = $request->input('id_empleado');
        $id_horarios = $request->input('id_horarios');
        $dia_aplica = $request->input('dia_aplica');
        $id_operador = auth()->id();
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $estatus='Activo';
            
        $hora_formateada = date('Y-m-d H:i:s', $hora_actual);
        $valida = DB::connection('mysql')->select('select * from t_horarios_enrolador_personal where id_empleado=? and estatus="Activo"', [
            $id_empleado,
          
        ]);
        if(count($valida)>0){
            $Inactivo = "Inactivo";
            $id = $valida[0]->id_t_horarios_enrolador_personal;
            DB::connection('mysql')->update(
                'UPDATE t_horarios_enrolador_personal 
                 SET fecha_fin = ?, estatus = ? 
                 WHERE id_t_horarios_enrolador_personal = ?', 
                [
                    $dia_aplica,
                    $Inactivo,
                    $id,
                ]
            );
            
        }

        $insert = DB::connection('mysql')->insert('insert into t_horarios_enrolador_personal (fecha_inicio,id_empleado,id_horario,fecha_registro,id_operador,estatus) 
        values (?,?,?,?,?,?); ', [
            $dia_aplica,
            $id_empleado,
            $id_horarios,
            $hora_formateada,
            $id_operador,
            $estatus,
        ]);
        
        $mensaje="Se enrolo el horario con éxito ";
        $color="success";
        
        return redirect()->route('Enrolar_horarios')->with('mensaje', $mensaje)->with('color', $color);
    }
    public function Gestion_de_horarios()
    {
        $consulta = DB::connection('mysql')->select('SELECT * FROM t_horarios_personal where estatus="Activo" ;');
        
        return view('Transmasivo.rh.Gestion_de_horarios',compact('consulta'));
    }
    
    public function Gestion_de_horarios_por_id(Request $request)
    {
        $id = $request->input('id');
        
        return DB::connection('mysql')->select('SELECT * FROM t_horarios_personal where id_t_horarios_personal='.$id.';');
    }
    public function postGestion_de_horarios(Request $request)
    {
        if($request->has('Eliminar_horario')){
            $id_elimina = $request->input('id_hidden');
            $insert = DB::connection('mysql')->update('update t_horarios_personal set estatus="Inactivo" where id_t_horarios_personal = ?', 
            [
                $id_elimina
            ]);
            $desenrolar = DB::connection('mysql')->update('update t_horarios_enrolador_personal set id_horario=null where id_horario = ?', 
            [
                $id_elimina
            ]);
            
            $mensaje="Se elimino el horario con éxito ";
            $color="success";
            
            return redirect()->route('Gestion_de_horarios')->with('mensaje', $mensaje)->with('color', $color);
        }
        else if($request->has('Guardar_cambio'))
        {
            $nombre_h = $request->input('nombre_h_m');

            $Jornada_l = $request->input('Jornada_l_m');
            $h_llegada_l = $request->input('h_llegada_l_m');
            $h_i_comida_l = $request->input('h_i_comida_l_m');
            $h_f_comida_l = $request->input('h_f_comida_l_m');
            $h_salida_l = $request->input('h_salida_l_m');

            $Jornada_m = $request->input('Jornada_m_m');
            $h_llegada_m = $request->input('h_llegada_m_m');
            $h_i_comida_m = $request->input('h_i_comida_m_m');
            $h_f_comida_m = $request->input('h_f_comida_m_m');
            $h_salida_m = $request->input('h_salida_m_m');

            $Jornada_mi = $request->input('Jornada_mi_m');
            $h_llegada_mi = $request->input('h_llegada_mi_m');
            $h_i_comida_mi = $request->input('h_i_comida_mi_m');
            $h_f_comida_mi = $request->input('h_f_comida_mi_m');
            $h_salida_mi = $request->input('h_salida_mi_m');
            
            $Jornada_j = $request->input('Jornada_j_m');
            $h_llegada_j = $request->input('h_llegada_j_m');
            $h_i_comida_j = $request->input('h_i_comida_j_m');
            $h_f_comida_j = $request->input('h_f_comida_j_m');
            $h_salida_j = $request->input('h_salida_j_m');
            
            $Jornada_v = $request->input('Jornada_v_m');
            $h_llegada_v = $request->input('h_llegada_v_m');
            $h_i_comida_v = $request->input('h_i_comida_v_m');
            $h_f_comida_v = $request->input('h_f_comida_v_m');
            $h_salida_v = $request->input('h_salida_v_m');
            
            $Jornada_s = $request->input('Jornada_s_m');
            $h_llegada_s = $request->input('h_llegada_s_m');
            $h_i_comida_s = $request->input('h_i_comida_s_m');
            $h_f_comida_s = $request->input('h_f_comida_s_m');
            $h_salida_s = $request->input('h_salida_s_m');
            
            $Jornada_d = $request->input('Jornada_d_m');
            $h_llegada_d = $request->input('h_llegada_d_m');
            $h_i_comida_d = $request->input('h_i_comida_d_m');
            $h_f_comida_d = $request->input('h_f_comida_d_m');
            $h_salida_d = $request->input('h_salida_d_m');
            $id_hidden = $request->input('id_hidden_m');
            //dd($request->all());
            $update = DB::connection('mysql')->update('update t_horarios_personal set 
            nombre_horario =?  , 
            jornada_l =?  ,  hora_llegada_l =?  ,  hora_inicio_comida_l =?  ,  hora_fin_comida_l =?  ,  hora_salida_l =?  , 
            jornada_m =?  ,  hora_llegada_m =?  ,  hora_inicio_comida_m =?  ,  hora_fin_comida_m =?  ,  hora_salida_m =?  , 
            jornada_mi =?  ,  hora_llegada_mi =?  ,  hora_inicio_comida_mi =?  ,  hora_fin_comida_mi =?  ,  hora_salida_mi =?  , 
            jornada_j =?  ,  hora_llegada_j =?  ,  hora_inicio_comida_j =?  ,  hora_fin_comida_j =?  ,  hora_salida_j =?  , 
            jornada_v =?  ,  hora_llegada_v =?  ,  hora_inicio_comida_v =?  ,  hora_fin_comida_v =?  ,  hora_salida_v =?  , 
            jornada_s =?  ,  hora_llegada_s =?  ,  hora_inicio_comida_s =?  ,  hora_fin_comida_s =?  ,  hora_salida_s =?  , 
            jornada_d =?  ,  hora_llegada_d =?  ,  hora_inicio_comida_d =?  ,  hora_fin_comida_d =?  ,  hora_salida_d =? 
           where  id_t_horarios_personal =? ', [
                $nombre_h,

                $Jornada_l,
                $h_llegada_l,
                $h_i_comida_l,
                $h_f_comida_l,
                $h_salida_l,

                $Jornada_m,
                $h_llegada_m,
                $h_i_comida_m,
                $h_f_comida_m,
                $h_salida_m,

                $Jornada_mi,
                $h_llegada_mi,
                $h_i_comida_mi,
                $h_f_comida_mi,
                $h_salida_mi,

                $Jornada_j,
                $h_llegada_j,
                $h_i_comida_j,
                $h_f_comida_j,
                $h_salida_j,

                $Jornada_v,
                $h_llegada_v,
                $h_i_comida_v,
                $h_f_comida_v,
                $h_salida_v,

                $Jornada_s,
                $h_llegada_s,
                $h_i_comida_s,
                $h_f_comida_s,
                $h_salida_s,

                $Jornada_d,
                $h_llegada_d,
                $h_i_comida_d,
                $h_f_comida_d,
                $h_salida_d,
                $id_hidden
            ]);
            $mensaje="Se modifico el horario ".$nombre_h." con exito ";
            $color="success";
            
            return redirect()->route('Gestion_de_horarios')->with('mensaje', $mensaje)->with('color', $color);

        }else{
            
            //dd($request->all());
            $nombre_h = $request->input('nombre_h');

            $Jornada_l = $request->input('Jornada_l');
            $h_llegada_l = $request->input('h_llegada_l');
            $h_i_comida_l = $request->input('h_i_comida_l');
            $h_f_comida_l = $request->input('h_f_comida_l');
            $h_salida_l = $request->input('h_salida_l');

            $Jornada_m = $request->input('Jornada_m');
            $h_llegada_m = $request->input('h_llegada_m');
            $h_i_comida_m = $request->input('h_i_comida_m');
            $h_f_comida_m = $request->input('h_f_comida_m');
            $h_salida_m = $request->input('h_salida_m');

            $Jornada_mi = $request->input('Jornada_mi');
            $h_llegada_mi = $request->input('h_llegada_mi');
            $h_i_comida_mi = $request->input('h_i_comida_mi');
            $h_f_comida_mi = $request->input('h_f_comida_mi');
            $h_salida_mi = $request->input('h_salida_mi');
            
            $Jornada_j = $request->input('Jornada_j');
            $h_llegada_j = $request->input('h_llegada_j');
            $h_i_comida_j = $request->input('h_i_comida_j');
            $h_f_comida_j = $request->input('h_f_comida_j');
            $h_salida_j = $request->input('h_salida_j');
            
            $Jornada_v = $request->input('Jornada_v');
            $h_llegada_v = $request->input('h_llegada_v');
            $h_i_comida_v = $request->input('h_i_comida_v');
            $h_f_comida_v = $request->input('h_f_comida_v');
            $h_salida_v = $request->input('h_salida_v');
            
            $Jornada_s = $request->input('Jornada_s');
            $h_llegada_s = $request->input('h_llegada_s');
            $h_i_comida_s = $request->input('h_i_comida_s');
            $h_f_comida_s = $request->input('h_f_comida_s');
            $h_salida_s = $request->input('h_salida_s');
            
            $Jornada_d = $request->input('Jornada_d');
            $h_llegada_d = $request->input('h_llegada_d');
            $h_i_comida_d = $request->input('h_i_comida_d');
            $h_f_comida_d = $request->input('h_f_comida_d');
            $h_salida_d = $request->input('h_salida_d');

            $id_operador = auth()->id();
            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();
            $estatus='Activo';
                
            $hora_formateada = date('Y-m-d H:i:s', $hora_actual);

            $insert = DB::connection('mysql')->insert('insert into t_horarios_personal 
            (nombre_horario,
            jornada_l, hora_llegada_l, hora_inicio_comida_l, hora_fin_comida_l, hora_salida_l,
            jornada_m, hora_llegada_m, hora_inicio_comida_m, hora_fin_comida_m, hora_salida_m,
            jornada_mi, hora_llegada_mi, hora_inicio_comida_mi, hora_fin_comida_mi, hora_salida_mi,
            jornada_j, hora_llegada_j, hora_inicio_comida_j, hora_fin_comida_j, hora_salida_j,
            jornada_v, hora_llegada_v, hora_inicio_comida_v, hora_fin_comida_v, hora_salida_v,
            jornada_s, hora_llegada_s, hora_inicio_comida_s, hora_fin_comida_s, hora_salida_s,
            jornada_d, hora_llegada_d, hora_inicio_comida_d, hora_fin_comida_d, hora_salida_d,
            fecha_registro,id_operador,estatus) 
            values (
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?); ', [
                $nombre_h,

                $Jornada_l,
                $h_llegada_l,
                $h_i_comida_l,
                $h_f_comida_l,
                $h_salida_l,

                $Jornada_m,
                $h_llegada_m,
                $h_i_comida_m,
                $h_f_comida_m,
                $h_salida_m,

                $Jornada_mi,
                $h_llegada_mi,
                $h_i_comida_mi,
                $h_f_comida_mi,
                $h_salida_mi,

                $Jornada_j,
                $h_llegada_j,
                $h_i_comida_j,
                $h_f_comida_j,
                $h_salida_j,

                $Jornada_v,
                $h_llegada_v,
                $h_i_comida_v,
                $h_f_comida_v,
                $h_salida_v,

                $Jornada_s,
                $h_llegada_s,
                $h_i_comida_s,
                $h_f_comida_s,
                $h_salida_s,

                $Jornada_d,
                $h_llegada_d,
                $h_i_comida_d,
                $h_f_comida_d,
                $h_salida_d,


                $hora_formateada,
                $id_operador,
                $estatus,
            ]);
            $mensaje="Se regristro el horario con éxito ";
            $color="success";
            
            return redirect()->route('Gestion_de_horarios')->with('mensaje', $mensaje)->with('color', $color);
        }
        
    }
    

}
