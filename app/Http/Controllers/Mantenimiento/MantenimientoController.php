<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BitacoraLiberacionUnidades;
use App\Models\BitacoraLiberacionUnidadesElectrico;
use App\Models\Flota;
use App\Models\Marca_flota;
use App\Exports\bitacoraMantenimiento;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Dompdf\Dompdf;
use App\Mail\mantenimientoMail;
use Illuminate\Support\Facades\Mail;

class MantenimientoController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
    }
    public function sendWelcomeEmail()
    {
        $name = 'John Doe'; // Esto puede ser el nombre del usuario real

    }

    public function Revisión()
    {
        
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
            INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo asc');
        $fallas = DB::connection('mysql')->select('SELECT * FROM c_fallas_subseccion_liberacion_unidades where estatus="Activo" ');
        $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO" and empresa=2');

        return view('Transmasivo.Mantenimiento.Revision2',compact('unidades','fallas','mecanicos'));
    }
    public function Bitacora_De_Liberacion_De_Unidades_express()
    {
        
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
            INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo asc');
        $fallas = DB::connection('mysql')->select('SELECT * FROM c_fallas_subseccion_liberacion_unidades where estatus="Activo" ');
        $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO" and empresa=2');

        return view('Transmasivo.Mantenimiento.Bitacora_De_Liberacion_De_Unidades_express',compact('unidades','fallas','mecanicos'));
    }
    public function Revisiónv1()
    {
        
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
            INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo asc');
        $fallas = DB::connection('mysql')->select('SELECT * FROM c_fallas_subseccion_liberacion_unidades where estatus="Activo" ');

        return view('Transmasivo.Mantenimiento.Revision',compact('unidades','fallas'));
    }

    public function Catalogo_de_fallas($color="",$mensaje="")
    {
        $fallas = DB::connection('mysql')->select('SELECT * FROM c_fallas_subseccion_liberacion_unidades ');
        $seccion = DB::connection('mysql')->select('SELECT * FROM c_seccion_liberacion_unidades where id_seccion_liberacion_unidades not in(22)');
        $subseccion = DB::connection('mysql')->select('SELECT * FROM c_subseccion_liberacion_unidades ');

        return view('Transmasivo.Mantenimiento.Catalogo_de_fallas',compact('fallas','seccion','subseccion','color','mensaje'));
    }
    public function registro_de_falla(Request $request)
    {
        $seccion=$request->input('seccion');
        $subseccion=$request->input('subseccion');
        $falla=$request->input('falla');
        
        $valida = DB::connection('mysql')->select('SELECT * FROM c_fallas_subseccion_liberacion_unidades where id_seccion='.$seccion.' and id_subseccion='.$subseccion.' and falla="'.$falla.'"');
        if($valida)
        {
            return $this->Catalogo_de_fallas("danger", "Registro duplicado");
        }
        $subseccion = 
        DB::connection('mysql')->select('INSERT INTO c_fallas_subseccion_liberacion_unidades (id_seccion, id_subseccion, falla) VALUES ('.$seccion.', '.$subseccion.',"'.$falla.'");  ');
            $color="success";
            $mensaje="Se registro con exito";
            
            return $this->Catalogo_de_fallas("success", "Se registró con éxito");
        }
        public function Catalogo_de_fallas_consulta(Request $request)
        {
            $seccion=$request->input('seccion');
            $subseccion=$request->input('subseccion');
            return DB::connection('mysql')->select('SELECT c_fallas_subseccion_liberacion_unidades.falla,c_fallas_subseccion_liberacion_unidades.id_fallas_subseccion_liberacion_unidades,c_fallas_subseccion_liberacion_unidades.estatus,c_seccion_liberacion_unidades.seccion,c_subseccion_liberacion_unidades.subseccion 
                FROM c_fallas_subseccion_liberacion_unidades 
                INNER JOIN c_seccion_liberacion_unidades ON c_seccion_liberacion_unidades.id_seccion_liberacion_unidades=c_fallas_subseccion_liberacion_unidades.id_seccion
                
                INNER JOIN c_subseccion_liberacion_unidades ON c_subseccion_liberacion_unidades.id_subseccion_liberacion_unidades=c_fallas_subseccion_liberacion_unidades.id_subseccion
                where c_fallas_subseccion_liberacion_unidades.id_seccion= '.$seccion.' and c_fallas_subseccion_liberacion_unidades.id_subseccion='.$subseccion);

        }
        public function Catalogo_de_fallas_baja(Request $request)
        {
            $id=$request->input('id');
            DB::connection('mysql')->update('UPDATE c_fallas_subseccion_liberacion_unidades
                SET estatus = "Baja"
                WHERE id_fallas_subseccion_liberacion_unidades = '.$id.';
                ');
            
        }

        public function Catalogo_de_fallas_alta(Request $request)
        {
            $id=$request->input('id');
            DB::connection('mysql')->update('UPDATE c_fallas_subseccion_liberacion_unidades
                SET estatus = "Activo"
                WHERE id_fallas_subseccion_liberacion_unidades = '.$id.';
                ');
            
        }
        public function consultakm(Request $request)
        {
            
            return DB::connection('mysql_produc')->select('SELECT reportesupervicion.FechaReporte, reportesupervicion.KmEntrada, cunidades.idunidad 
                FROM reportesupervicion
                INNER JOIN cunidades ON cunidades.idunidad = reportesupervicion.UnidadfkCUnidades
                WHERE cunidades.idunidad = '.$request->input('economico').'
                ORDER BY reportesupervicion.FechaReporte DESC
                LIMIT 1;');
        }
        public function Bitacora_Liberacion_De_Unidades()
        {
            $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
                INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
            $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
            $tipo_informes = DB::connection('mysql')->select('SELECT * FROM c_tipo_informe_bitacora_liberacion ');
            return view('Transmasivo.Mantenimiento.Bitacora',compact('unidades','mecanicos','tipo_informes'));
        }
        
        public function Alta_de_bitacora_express(Request $request){
            $request->validate([
            ]);
            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();

            $hora_una_hora_atras = $hora_actual - 3600;

            $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
            $bitacora = new BitacoraLiberacionUnidades;
            $km = $request->input('km');
            $km = str_replace(',', '', $km);
            $bitacora->n_economico = $request->input('n_economico');
            $bitacora->fecha_creacion = $hora_formateada;
            $bitacora->n_mecanico = $request->input('n_mecanico');
            $bitacora->nom_supervisor = $request->input('nom_supervisor');
            $bitacora->Fecha = $request->input('Fecha');
            $bitacora->km = $km ;
            $bitacora->bares = $request->input('bares');
            $bitacora->aceite_motor = $request->input('aceite_motor');
            $aceite_lt=$request->input('aceite_motor_lt');
            if($aceite_lt == null)
            {
                $aceite_lt = 0;
            }
            $bitacora->aceite_motor_lt = $aceite_lt;
            $bitacora->aceite_motor_o = $request->input('aceite_motor_o');
            $bitacora->refrigerante = $request->input('refrigerante');
            $refrigerant_lt=$request->input('refrigerante_lt');
            if($refrigerant_lt == null)
            {
                $refrigerant_lt = 0;
            }
            
            $bitacora->refrigerante_lt = $refrigerant_lt;
            $bitacora->refrigerante_o = $request->input('refrigerante_o');
            $bitacora->aceite_hidra = $request->input('aceite_hidra');
            $aceite_hidr_lt=$request->input('aceite_hidra_lt');
            if($aceite_hidr_lt == null)
            {
                $aceite_hidr_lt = 0;
            }
            

            $bitacora->aceite_hidra_lt = $aceite_hidr_lt;
            $bitacora->aceite_hidra_o = $request->input('aceite_hidra_o');
            $bitacora->hidroven = $request->input('hidroven');

            $hidrove_lt=$request->input('hidroven_lt');
            if($hidrove_lt == null)
            {
                $hidrove_lt = 0;
            }
            $bitacora->hidroven_lt = $hidrove_lt;
            $bitacora->hidroven_o = $request->input('hidroven_o');
            $bitacora->servicio = $request->input('servicio');
            $bitacora->servicio_o = $request->input('servicio_o');
            $bitacora->emergencia = $request->input('emergencia');
            $bitacora->emergencia_o = $request->input('emergencia_o');
            $bitacora->neu_eje_dir_izq = $request->input('neu_eje_dir_izq');
            $bitacora->neu_eje_dir_izq_o = $request->input('neu_eje_dir_izq_o');
            $bitacora->neu_eje_dir_der = $request->input('neu_eje_dir_der');
            $bitacora->neu_eje_dir_der_o = $request->input('neu_eje_dir_der_o');
            $bitacora->neu_eje_int_izq = $request->input('neu_eje_int_izq');
            $bitacora->neu_eje_int_izq_o = $request->input('neu_eje_int_izq_o');
            $bitacora->neu_eje_int_der = $request->input('neu_eje_int_der');
            $bitacora->neu_eje_int_der_o = $request->input('neu_eje_int_der_o');
            $bitacora->neu_eje_motr_izq = $request->input('neu_eje_motr_izq');
            $bitacora->neu_eje_motr_izq_o = $request->input('neu_eje_motr_izq_o');
            $bitacora->neu_eje_motr_der = $request->input('neu_eje_motr_der');
            $bitacora->neu_eje_motr_der_o = $request->input('neu_eje_motr_der_o');
            $bitacora->bal_eje_dir_izq = $request->input('bal_eje_dir_izq');
            $bitacora->bal_eje_dir_izq_o = $request->input('bal_eje_dir_izq_o');
            $bitacora->bal_eje_dir_der = $request->input('bal_eje_dir_der');
            $bitacora->bal_eje_dir_der_o = $request->input('bal_eje_dir_der_o');
            $bitacora->bal_eje_int_izq = $request->input('bal_eje_int_izq');
            $bitacora->bal_eje_int_izq_o = $request->input('bal_eje_int_izq_o');
            $bitacora->bal_eje_int_der = $request->input('bal_eje_int_der');
            $bitacora->bal_eje_int_der_o = $request->input('bal_eje_int_der_o');
            $bitacora->bal_eje_motr_izq = $request->input('bal_eje_motr_izq');
            $bitacora->bal_eje_motr_izq_o = $request->input('bal_eje_motr_izq_o');
            $bitacora->bal_eje_motr_der = $request->input('bal_eje_motr_der');
            $bitacora->bal_eje_motr_der_o = $request->input('bal_eje_motr_der_o');
            $bitacora->bols_air_eje_dir_izq = $request->input('bols_air_eje_dir_izq');
            $bitacora->bols_air_eje_dir_izq_o = $request->input('bols_air_eje_dir_izq_o');
            $bitacora->bols_air_eje_dir_der = $request->input('bols_air_eje_dir_der');
            $bitacora->bols_air_eje_dir_der_o = $request->input('bols_air_eje_dir_der_o');
            $bitacora->bols_air_eje_int_izq = $request->input('bols_air_eje_int_izq');
            $bitacora->bols_air_eje_int_izq_o = $request->input('bols_air_eje_int_izq_o');
            $bitacora->bols_air_eje_int_der = $request->input('bols_air_eje_int_der');
            $bitacora->bols_air_eje_int_der_o = $request->input('bols_air_eje_int_der_o');
            $bitacora->bols_air_eje_motr_izq = $request->input('bols_air_eje_motr_izq');
            $bitacora->bols_air_eje_motr_izq_o = $request->input('bols_air_eje_motr_izq_o');
            $bitacora->bols_air_eje_motr_der = $request->input('bols_air_eje_motr_der');
            $bitacora->bols_air_eje_motr_der_o = $request->input('bols_air_eje_motr_der_o');
            $bitacora->asiento_conductor = $request->input('asiento_conductor');
            $bitacora->asiento_conductor_o = $request->input('asiento_conductor_o');
            $bitacora->asiento_carro1 = $request->input('asiento_carro1');
            $bitacora->asiento_carro1_o = $request->input('asiento_carro1_o');
            $bitacora->asiento_carro2 = $request->input('asiento_carro2');
            $bitacora->asiento_carro2_o = $request->input('asiento_carro2_o');
            $bitacora->pasamanos_carro1 = $request->input('pasamanos_carro1');
            $bitacora->pasamanos_carro1_o = $request->input('pasamanos_carro1_o');
            $bitacora->pasamanos_carro2 = $request->input('pasamanos_carro2');
            $bitacora->pasamanos_carro2_o = $request->input('pasamanos_carro2_o');
            $bitacora->codigo_display = $request->input('codigo_display');
            $bitacora->codigo_display_o = $request->input('codigo_display_o');
            $bitacora->articulacion = $request->input('articulacion');
            $bitacora->articulacion_o = $request->input('articulacion_o');
            $bitacora->articulacion_soporte = $request->input('articulacion_soporte');
            $bitacora->articulacion_soporte_o = $request->input('articulacion_soporte_o');
            $bitacora->articulacion_granada = $request->input('articulacion_granada');
            $bitacora->articulacion_granada_o = $request->input('articulacion_granada_o');
            $bitacora->calibracion_neum_granada = $request->input('calibracion_neum_granada');
            $bitacora->calibracion_neum_granada_o = $request->input('calibracion_neum_granada_o');
            $bitacora->eje_dir_izq = $request->input('eje_dir_izq');
            $bitacora->eje_dir_izq_o = $request->input('eje_dir_izq_o');
            $bitacora->eje_dir_der = $request->input('eje_dir_der');
            $bitacora->eje_dir_der_o = $request->input('eje_dir_der_o');
            $bitacora->eje_inter_izq = $request->input('eje_inter_izq');
            $bitacora->eje_inter_izq_o = $request->input('eje_inter_izq_o');
            $bitacora->eje_inter_der = $request->input('eje_inter_der');
            $bitacora->eje_inter_der_o = $request->input('eje_inter_der_o');
            $bitacora->eje_motr_izq = $request->input('eje_motr_izq');
            $bitacora->eje_motr_izq_o = $request->input('eje_motr_izq_o');
            $bitacora->eje_motr_der = $request->input('eje_motr_der');
            $bitacora->eje_motr_der_o = $request->input('eje_motr_der_o');
            $bitacora->susp_eje1 = $request->input('susp_eje1');
            $bitacora->susp_eje1_o = $request->input('susp_eje1_o');
            $bitacora->susp_eje2 = $request->input('susp_eje2');
            $bitacora->susp_eje2_o = $request->input('susp_eje2_o');
            $bitacora->susp_eje3 = $request->input('susp_eje3');
            $bitacora->susp_eje3_o = $request->input('susp_eje3_o');
            $bitacora->tan_drenado = $request->input('tan_drenado');
            $bitacora->tan_drenado_o = $request->input('tan_drenado_o');
            $bitacora->tan_chicote = $request->input('tan_chicotes');
            $bitacora->tan_chicote_o = $request->input('tan_chicotes_o');
            $bitacora->soport_motor = $request->input('soport_motor');
            $bitacora->soport_motor_o = $request->input('soport_motor_o');
            $bitacora->soport_transmi = $request->input('soport_transmi');
            $bitacora->soport_transmi_o = $request->input('soport_transmi_o');
            $bitacora->tipo_informe = 2;
            $bitacora->id_usuario_creacion = auth()->user()->id;
            $bitacora->save();
            $id_bitacora=DB::connection('mysql')->select('SELECT id_bitacora_liberacion_unidades FROM bitacora_liberacion_unidades
               where n_economico="'.$request->input('n_economico').'" and km="'.$km.'" and fecha_creacion="'.$hora_formateada.'" ');
            $formData = $request->all();
            $variablesConNumerosAlInicio = [];
            
            foreach ($formData as $nombre => $valor) {
               if (preg_match('/^\d/', $nombre)) {
                   $variablesConNumerosAlInicio[] = $nombre;
               }
           }
           $numerosAntesGuionBajo = [];
           $textoDespuesGuionBajo = [];

           foreach ($variablesConNumerosAlInicio as $cadena) {
            $partes = explode('_', $cadena, 2);
            $numerosAntesGuionBajo[] = $partes[0];
            $textoDespuesGuionBajo[] = $partes[1];
        }
        $id_c_falla=163;
        $resultadoInsercion = DB::connection('mysql')->insert('insert into detalle_falla_bitacora_liberacion_unidades values (null, ?, ?)', [
            $id_c_falla,
            $id_bitacora[0]->id_bitacora_liberacion_unidades
        ]);
        for ($i = 0; $i < count($numerosAntesGuionBajo); $i++) {
            $resultadoInsercion = DB::connection('mysql')->insert('insert into detalle_falla_bitacora_liberacion_unidades values (null, ?, ?)', [
                $numerosAntesGuionBajo[$i],
                $id_bitacora[0]->id_bitacora_liberacion_unidades
            ]);
            
            if ($resultadoInsercion === false) {
                Log::error('Error al insertar en la base de datos');
            }
        }
        $mensaje="Se registro con exito!";
        $color="success";
        
       
        Mail::mailer('smtp')->to('2517160117lcamarenas@gmail.com')->send(new mantenimientoMail());
        return redirect()->route('Bitacora_De_Liberacion_De_Unidades_express')->with('mensaje', $mensaje)->with('color', $color);
    }

    public function Alta_de_bitacora(Request $request)
    {
        $request->validate([
            // Agrega aquí las reglas de validación necesarias para cada campo si es necesario
        ]);
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();

        $hora_una_hora_atras = $hora_actual - 3600;

        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        //dd($request->all());
        $bitacora = new BitacoraLiberacionUnidades;
        $km = $request->input('km');
        $km = str_replace(',', '', $km);
        // Asignar los valores recibidos del formulario a los campos del modelo
        $bitacora->n_economico = $request->input('n_economico');
        $bitacora->fecha_creacion = $hora_formateada;
        $bitacora->n_mecanico = $request->input('n_mecanico');
        $bitacora->nom_supervisor = $request->input('nom_supervisor');
        $bitacora->Fecha = $request->input('Fecha');
        $bitacora->km = $km ;
        $bitacora->bares = $request->input('bares');
        $bitacora->aceite_motor = $request->input('aceite_motor');
        $aceite_lt=$request->input('aceite_motor_lt');
        if($aceite_lt == null)
        {
            $aceite_lt = 0;
        }
        $bitacora->aceite_motor_lt = $aceite_lt;
        $bitacora->aceite_motor_o = $request->input('aceite_motor_o');
        $bitacora->refrigerante = $request->input('refrigerante');
        $refrigerant_lt=$request->input('refrigerante_lt');
        if($refrigerant_lt == null)
        {
            $refrigerant_lt = 0;
        }
        
        $bitacora->refrigerante_lt = $refrigerant_lt;
        $bitacora->refrigerante_o = $request->input('refrigerante_o');
        $bitacora->aceite_hidra = $request->input('aceite_hidra');
        $aceite_hidr_lt=$request->input('aceite_hidra_lt');
        if($aceite_hidr_lt == null)
        {
            $aceite_hidr_lt = 0;
        }
        

        $bitacora->aceite_hidra_lt = $aceite_hidr_lt;
        $bitacora->aceite_hidra_o = $request->input('aceite_hidra_o');
        $bitacora->hidroven = $request->input('hidroven');

        $hidrove_lt=$request->input('hidroven_lt');
        if($hidrove_lt == null)
        {
            $hidrove_lt = 0;
        }
        $bitacora->hidroven_lt = $hidrove_lt;
        $bitacora->hidroven_o = $request->input('hidroven_o');
        $bitacora->servicio = $request->input('servicio');
        $bitacora->servicio_o = $request->input('servicio_o');
        $bitacora->emergencia = $request->input('emergencia');
        $bitacora->emergencia_o = $request->input('emergencia_o');
        $bitacora->neu_eje_dir_izq = $request->input('neu_eje_dir_izq');
        $bitacora->neu_eje_dir_izq_o = $request->input('neu_eje_dir_izq_o');
        $bitacora->neu_eje_dir_der = $request->input('neu_eje_dir_der');
        $bitacora->neu_eje_dir_der_o = $request->input('neu_eje_dir_der_o');
        $bitacora->neu_eje_int_izq = $request->input('neu_eje_int_izq');
        $bitacora->neu_eje_int_izq_o = $request->input('neu_eje_int_izq_o');
        $bitacora->neu_eje_int_der = $request->input('neu_eje_int_der');
        $bitacora->neu_eje_int_der_o = $request->input('neu_eje_int_der_o');
        $bitacora->neu_eje_motr_izq = $request->input('neu_eje_motr_izq');
        $bitacora->neu_eje_motr_izq_o = $request->input('neu_eje_motr_izq_o');
        $bitacora->neu_eje_motr_der = $request->input('neu_eje_motr_der');
        $bitacora->neu_eje_motr_der_o = $request->input('neu_eje_motr_der_o');
        $bitacora->bal_eje_dir_izq = $request->input('bal_eje_dir_izq');
        $bitacora->bal_eje_dir_izq_o = $request->input('bal_eje_dir_izq_o');
        $bitacora->bal_eje_dir_der = $request->input('bal_eje_dir_der');
        $bitacora->bal_eje_dir_der_o = $request->input('bal_eje_dir_der_o');
        $bitacora->bal_eje_int_izq = $request->input('bal_eje_int_izq');
        $bitacora->bal_eje_int_izq_o = $request->input('bal_eje_int_izq_o');
        $bitacora->bal_eje_int_der = $request->input('bal_eje_int_der');
        $bitacora->bal_eje_int_der_o = $request->input('bal_eje_int_der_o');
        $bitacora->bal_eje_motr_izq = $request->input('bal_eje_motr_izq');
        $bitacora->bal_eje_motr_izq_o = $request->input('bal_eje_motr_izq_o');
        $bitacora->bal_eje_motr_der = $request->input('bal_eje_motr_der');
        $bitacora->bal_eje_motr_der_o = $request->input('bal_eje_motr_der_o');
        $bitacora->bols_air_eje_dir_izq = $request->input('bols_air_eje_dir_izq');
        $bitacora->bols_air_eje_dir_izq_o = $request->input('bols_air_eje_dir_izq_o');
        $bitacora->bols_air_eje_dir_der = $request->input('bols_air_eje_dir_der');
        $bitacora->bols_air_eje_dir_der_o = $request->input('bols_air_eje_dir_der_o');
        $bitacora->bols_air_eje_int_izq = $request->input('bols_air_eje_int_izq');
        $bitacora->bols_air_eje_int_izq_o = $request->input('bols_air_eje_int_izq_o');
        $bitacora->bols_air_eje_int_der = $request->input('bols_air_eje_int_der');
        $bitacora->bols_air_eje_int_der_o = $request->input('bols_air_eje_int_der_o');
        $bitacora->bols_air_eje_motr_izq = $request->input('bols_air_eje_motr_izq');
        $bitacora->bols_air_eje_motr_izq_o = $request->input('bols_air_eje_motr_izq_o');
        $bitacora->bols_air_eje_motr_der = $request->input('bols_air_eje_motr_der');
        $bitacora->bols_air_eje_motr_der_o = $request->input('bols_air_eje_motr_der_o');
        $bitacora->asiento_conductor = $request->input('asiento_conductor');
        $bitacora->asiento_conductor_o = $request->input('asiento_conductor_o');
        $bitacora->asiento_carro1 = $request->input('asiento_carro1');
        $bitacora->asiento_carro1_o = $request->input('asiento_carro1_o');
        $bitacora->asiento_carro2 = $request->input('asiento_carro2');
        $bitacora->asiento_carro2_o = $request->input('asiento_carro2_o');
        $bitacora->pasamanos_carro1 = $request->input('pasamanos_carro1');
        $bitacora->pasamanos_carro1_o = $request->input('pasamanos_carro1_o');
        $bitacora->pasamanos_carro2 = $request->input('pasamanos_carro2');
        $bitacora->pasamanos_carro2_o = $request->input('pasamanos_carro2_o');
        $bitacora->codigo_display = $request->input('codigo_display');
        $bitacora->codigo_display_o = $request->input('codigo_display_o');
        $bitacora->articulacion = $request->input('articulacion');
        $bitacora->articulacion_o = $request->input('articulacion_o');
        $bitacora->articulacion_soporte = $request->input('articulacion_soporte');
        $bitacora->articulacion_soporte_o = $request->input('articulacion_soporte_o');
        $bitacora->articulacion_granada = $request->input('articulacion_granada');
        $bitacora->articulacion_granada_o = $request->input('articulacion_granada_o');
        $bitacora->calibracion_neum_granada = $request->input('calibracion_neum_granada');
        $bitacora->calibracion_neum_granada_o = $request->input('calibracion_neum_granada_o');
        $bitacora->eje_dir_izq = $request->input('eje_dir_izq');
        $bitacora->eje_dir_izq_o = $request->input('eje_dir_izq_o');
        $bitacora->eje_dir_der = $request->input('eje_dir_der');
        $bitacora->eje_dir_der_o = $request->input('eje_dir_der_o');
        $bitacora->eje_inter_izq = $request->input('eje_inter_izq');
        $bitacora->eje_inter_izq_o = $request->input('eje_inter_izq_o');
        $bitacora->eje_inter_der = $request->input('eje_inter_der');
        $bitacora->eje_inter_der_o = $request->input('eje_inter_der_o');
        $bitacora->eje_motr_izq = $request->input('eje_motr_izq');
        $bitacora->eje_motr_izq_o = $request->input('eje_motr_izq_o');
        $bitacora->eje_motr_der = $request->input('eje_motr_der');
        $bitacora->eje_motr_der_o = $request->input('eje_motr_der_o');
        $bitacora->susp_eje1 = $request->input('susp_eje1');
        $bitacora->susp_eje1_o = $request->input('susp_eje1_o');
        $bitacora->susp_eje2 = $request->input('susp_eje2');
        $bitacora->susp_eje2_o = $request->input('susp_eje2_o');
        $bitacora->susp_eje3 = $request->input('susp_eje3');
        $bitacora->susp_eje3_o = $request->input('susp_eje3_o');
        $bitacora->tan_drenado = $request->input('tan_drenado');
        $bitacora->tan_drenado_o = $request->input('tan_drenado_o');
        
        $bitacora->tan_chicote = $request->input('tan_chicotes');
        $bitacora->tan_chicote_o = $request->input('tan_chicotes_o');

        $bitacora->soport_motor = $request->input('soport_motor');
        $bitacora->soport_motor_o = $request->input('soport_motor_o');
        $bitacora->soport_transmi = $request->input('soport_transmi');
        $bitacora->soport_transmi_o = $request->input('soport_transmi_o');
        $bitacora->id_usuario_creacion = auth()->user()->id;
        
       
        $bitacora->tipo_informe = 1;
        // Asigna el resto de los campos de acuerdo a la estructura de tu formulario

        // Guardar el registro en la base de datos
        $bitacora->save();
        $id_bitacora=DB::connection('mysql')->select('SELECT id_bitacora_liberacion_unidades FROM bitacora_liberacion_unidades
           where n_economico="'.$request->input('n_economico').'" and km="'.$km.'" and fecha_creacion="'.$hora_formateada.'" ');
         //dd($id_bitacora);
        $formData = $request->all();
        $variablesConNumerosAlInicio = [];
        
        foreach ($formData as $nombre => $valor) {
           if (preg_match('/^\d/', $nombre)) {
               $variablesConNumerosAlInicio[] = $nombre;
           }
       }
       $numerosAntesGuionBajo = [];
       $textoDespuesGuionBajo = [];

       foreach ($variablesConNumerosAlInicio as $cadena) {
    // Dividir la cadena en dos partes basadas en el guion bajo
        $partes = explode('_', $cadena, 2);

    // Agregar la primera parte (los números) al arreglo $numerosAntesGuionBajo
        $numerosAntesGuionBajo[] = $partes[0];

    // Agregar la segunda parte (el texto) al arreglo $textoDespuesGuionBajo
        $textoDespuesGuionBajo[] = $partes[1];
    }
         //dd($numerosAntesGuionBajo);
    $id_c_falla=163;
    $resultadoInsercion = DB::connection('mysql')->insert('insert into detalle_falla_bitacora_liberacion_unidades values (null, ?, ?)', [
        $id_c_falla,
        $id_bitacora[0]->id_bitacora_liberacion_unidades
    ]);
    for ($i = 0; $i < count($numerosAntesGuionBajo); $i++) {
        $resultadoInsercion = DB::connection('mysql')->insert('insert into detalle_falla_bitacora_liberacion_unidades values (null, ?, ?)', [
            $numerosAntesGuionBajo[$i],
            $id_bitacora[0]->id_bitacora_liberacion_unidades
        ]);
        
        if ($resultadoInsercion === false) {
                // Manejar el error de inserción
                // Por ejemplo, puedes registrar el error, lanzar una excepción, etc.
                // Aquí hay un ejemplo de cómo registrar el error:
            Log::error('Error al insertar en la base de datos');
        }
    }
        // dd($textoDespuesGuionBajo);
        // Redireccionar o devolver una respuesta según lo necesites
    $mensaje="Se registro con exito!";
    $color="success";
    return redirect()->route('Alta_de_bitacora')->with('mensaje', $mensaje)->with('color', $color);

}
public function Consulta_bitacora(Request $request)
{
    if($request->has('Exportar_pdf'))
    {
        $res = json_decode($request->input('consulta'), true);
        $consulta_fallas = json_decode($request->input('consulta_fallas'), true);
                //dd($consulta_fallas);
        $i=0;
        
        //dd( $consulta_fallas);
          //  dd($res);
        foreach ($res as &$elemento) {
            $claves = array_keys($elemento);
            $indice = array_search('servicio', $claves);
            $emergencia = array_search('emergencia', $claves);
            $neu_eje_dir_izq = array_search('neu_eje_dir_izq', $claves);
            $neu_eje_dir_der = array_search('neu_eje_dir_der', $claves);
            $neu_eje_int_izq = array_search('neu_eje_int_izq', $claves);
            $neu_eje_int_der = array_search('neu_eje_int_der', $claves);
            $neu_eje_motr_izq = array_search('neu_eje_motr_izq', $claves);
            $neu_eje_motr_der = array_search('neu_eje_motr_der', $claves);
            $bal_eje_dir_izq = array_search('bal_eje_dir_izq', $claves);
            $bal_eje_dir_der = array_search('bal_eje_dir_der', $claves);
            $bal_eje_int_izq = array_search('bal_eje_int_izq', $claves);
            $bal_eje_int_der = array_search('bal_eje_int_der', $claves);
            $bal_eje_motr_izq = array_search('bal_eje_motr_izq', $claves);
            $bal_eje_motr_der = array_search('bal_eje_motr_der', $claves);
            $bols_air_eje_dir_izq = array_search('bols_air_eje_dir_izq', $claves);
            $bols_air_eje_dir_der = array_search('bols_air_eje_dir_der', $claves);
            $bols_air_eje_int_izq = array_search('bols_air_eje_int_izq', $claves);
            $bols_air_eje_int_der = array_search('bols_air_eje_int_der', $claves);
            $bols_air_eje_motr_izq = array_search('bols_air_eje_motr_izq', $claves);
            $bols_air_eje_motr_der = array_search('bols_air_eje_motr_der', $claves);
            $asiento_conductor = array_search('asiento_conductor', $claves);
            $asiento_carro1 = array_search('asiento_carro1', $claves);
            $asiento_carro2 = array_search('asiento_carro2', $claves);
            $articulacion = array_search('articulacion', $claves);
            $articulacion_soporte = array_search('articulacion_soporte', $claves);
            $articulacion_granada = array_search('articulacion_granada', $claves);
            $calibracion_neum_granada = array_search('calibracion_neum_granada', $claves);
            $eje_dir_izq = array_search('eje_dir_izq', $claves);
            $eje_dir_der = array_search('eje_dir_der', $claves);
            $eje_inter_izq = array_search('eje_inter_izq', $claves);
            $eje_inter_der = array_search('eje_inter_der', $claves);
            $eje_motr_izq = array_search('eje_motr_izq', $claves);
            $eje_motr_der = array_search('eje_motr_der', $claves);
            $susp_eje1 = array_search('susp_eje1', $claves);
            $susp_eje2 = array_search('susp_eje2', $claves);
            $susp_eje3 = array_search('susp_eje3', $claves);
            $tan_drenado = array_search('tan_drenado', $claves);
            $tan_chicote = array_search('tan_chicote', $claves);
            $soport_motor = array_search('soport_motor', $claves);
            $soport_transmi = array_search('soport_transmi', $claves);
            
            if ($indice !== false) {
                $nuevas_columnas = ['servicio_fallas' => $consulta_fallas[$i]['Puertas__SERVICIO'],];
                $elemento = array_merge(array_slice($elemento, 0, $indice + 1),$nuevas_columnas,array_slice($elemento, $indice + 1));
            }
            if ($emergencia !== false) { $nuevas_columnas = ['emergencia_fallas' => $consulta_fallas[$i]['Puertas__EMERGENCIA'],];
            $elemento = array_merge(array_slice($elemento, 0, $emergencia + 2),$nuevas_columnas,array_slice($elemento, $emergencia + 1) );
        }
        if ($neu_eje_dir_izq !== false) { $nuevas_columnas = ['neu_eje_dir_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO'],];
        $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_izq + 3),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_izq + 1) );
    }
    if ($neu_eje_dir_der !== false) { $nuevas_columnas = ['neu_eje_dir_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO'],];
    $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_der + 4),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_der + 1) );
}
if ($neu_eje_int_izq !== false) { $nuevas_columnas = ['neu_eje_int_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_izq + 5),$nuevas_columnas,array_slice($elemento, $neu_eje_int_izq + 1) );
}
if ($neu_eje_int_der !== false) { $nuevas_columnas = ['neu_eje_int_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_der + 6),$nuevas_columnas,array_slice($elemento, $neu_eje_int_der + 1) );
}
if ($neu_eje_motr_izq !== false) { $nuevas_columnas = ['neu_eje_motr_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_izq + 7),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_izq + 1) );
}
if ($neu_eje_motr_der !== false) { $nuevas_columnas = ['neu_eje_motr_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_der + 8),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_der + 1) );
}
if ($bal_eje_dir_izq !== false) { $nuevas_columnas = ['bal_eje_dir_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_izq + 9),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_izq + 1) );
}
if ($bal_eje_dir_der !== false) { $nuevas_columnas = ['bal_eje_dir_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_der + 10),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_der + 1) );
}
if ($bal_eje_int_izq !== false) { $nuevas_columnas = ['bal_eje_int_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_izq + 11),$nuevas_columnas,array_slice($elemento, $bal_eje_int_izq + 1) );
}
if ($bal_eje_int_der !== false) { $nuevas_columnas = ['bal_eje_int_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_der + 12),$nuevas_columnas,array_slice($elemento, $bal_eje_int_der + 1) );
}
if ($bal_eje_motr_izq !== false) { $nuevas_columnas = ['bal_eje_motr_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_izq + 13),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_izq + 1) );
}
if ($bal_eje_motr_der !== false) { $nuevas_columnas = ['bal_eje_motr_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_der + 14),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_der + 1) );
}
if ($bols_air_eje_dir_izq !== false) { $nuevas_columnas = ['bols_air_eje_dir_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_izq + 15),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_izq + 1) );
}
if ($bols_air_eje_dir_der !== false) { $nuevas_columnas = ['bols_air_eje_dir_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_der + 16),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_der + 1) );
}
if ($bols_air_eje_int_izq !== false) { $nuevas_columnas = ['bols_air_eje_int_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_izq + 17),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_izq + 1) );
}
if ($bols_air_eje_int_der !== false) { $nuevas_columnas = ['bols_air_eje_int_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_der + 18),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_der + 1) );
}
if ($bols_air_eje_motr_izq !== false) { $nuevas_columnas = ['bols_air_eje_motr_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_izq + 19),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_izq + 1) );
}
if ($bols_air_eje_motr_der !== false) { $nuevas_columnas = ['bols_air_eje_motr_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_der + 20),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_der + 1) );
}
if ($asiento_conductor !== false) { $nuevas_columnas = ['asiento_conductor_fallas' => $consulta_fallas[$i]['ASIENTOS__CONDUCTOR'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_conductor + 21),$nuevas_columnas,array_slice($elemento, $asiento_conductor + 1) );
}
if ($asiento_carro1 !== false) { $nuevas_columnas = ['asiento_carro1_fallas' => $consulta_fallas[$i]['ASIENTOS__CARRO_1'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro1 + 22),$nuevas_columnas,array_slice($elemento, $asiento_carro1 + 1) );
}
if ($asiento_carro2 !== false) { $nuevas_columnas = ['asiento_carro2_fallas' => $consulta_fallas[$i]['ASIENTOS__CARRO_2'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro2 + 23),$nuevas_columnas,array_slice($elemento, $asiento_carro2 + 1) );
}
if ($articulacion !== false) { $nuevas_columnas = ['articulacion_fallas' => $consulta_fallas[$i]['ARTICULACION__ARTICULACION'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion + 24),$nuevas_columnas,array_slice($elemento, $articulacion + 1) );
}
if ($articulacion_soporte !== false) { $nuevas_columnas = ['articulacion_soporte_fallas' => $consulta_fallas[$i]['ARTICULACION__SOPORTE'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_soporte + 25),$nuevas_columnas,array_slice($elemento, $articulacion_soporte + 1) );
}
if ($articulacion_granada !== false) { $nuevas_columnas = ['articulacion_granada_fallas' => $consulta_fallas[$i]['ARTICULACION__GRANADAS'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_granada + 26),$nuevas_columnas,array_slice($elemento, $articulacion_granada + 1) );
}
if ($calibracion_neum_granada !== false) { $nuevas_columnas = ['calibracion_neum_granada_fallas' => $consulta_fallas[$i]['CALIBRACION_DE_NEUMATICOS__GRANADAS'],];
$elemento = array_merge(array_slice($elemento, 0, $calibracion_neum_granada + 27),$nuevas_columnas,array_slice($elemento, $calibracion_neum_granada + 1) );
}
if ($eje_dir_izq !== false) { $nuevas_columnas = ['eje_dir_izq_fallas' => $consulta_fallas[$i]['EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_izq + 28),$nuevas_columnas,array_slice($elemento, $eje_dir_izq + 1) );
}
if ($eje_dir_der !== false) { $nuevas_columnas = ['eje_dir_der_fallas' => $consulta_fallas[$i]['EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_der + 29),$nuevas_columnas,array_slice($elemento, $eje_dir_der + 1) );
}
if ($eje_inter_izq !== false) { $nuevas_columnas = ['eje_inter_izq_fallas' => $consulta_fallas[$i]['EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_izq + 30),$nuevas_columnas,array_slice($elemento, $eje_inter_izq + 1) );
}
if ($eje_inter_der !== false) { $nuevas_columnas = ['eje_inter_der_fallas' => $consulta_fallas[$i]['EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_der + 31),$nuevas_columnas,array_slice($elemento, $eje_inter_der + 1) );
}
if ($eje_motr_izq !== false) { $nuevas_columnas = ['eje_motr_izq_fallas' => $consulta_fallas[$i]['EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_izq + 32),$nuevas_columnas,array_slice($elemento, $eje_motr_izq + 1) );
}
if ($eje_motr_der !== false) { $nuevas_columnas = ['eje_motr_der_fallas' => $consulta_fallas[$i]['EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_der + 33),$nuevas_columnas,array_slice($elemento, $eje_motr_der + 1) );
}
if ($susp_eje1 !== false) { $nuevas_columnas = ['susp_eje1_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_1'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje1 + 34),$nuevas_columnas,array_slice($elemento, $susp_eje1 + 1) );
}
if ($susp_eje2 !== false) { $nuevas_columnas = ['susp_eje2_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_2'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje2 + 35),$nuevas_columnas,array_slice($elemento, $susp_eje2 + 1) );
}
if ($susp_eje3 !== false) { $nuevas_columnas = ['susp_eje3_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_3'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje3 + 36),$nuevas_columnas,array_slice($elemento, $susp_eje3 + 1) );
}
if ($tan_drenado !== false) { $nuevas_columnas = ['tan_drenado_fallas' => $consulta_fallas[$i]['TANQUE__DRENADO'],];
$elemento = array_merge(array_slice($elemento, 0, $tan_drenado + 37),$nuevas_columnas,array_slice($elemento, $tan_drenado + 1) );
}
if ($tan_chicote !== false) { $nuevas_columnas = ['tan_chicote_fallas' => $consulta_fallas[$i]['TANQUE__CHICOTES'],];
$elemento = array_merge(array_slice($elemento, 0, $tan_chicote + 38),$nuevas_columnas,array_slice($elemento, $tan_chicote + 1) );
}
if ($soport_motor !== false) { $nuevas_columnas = ['soport_motor_fallas' => $consulta_fallas[$i]['SOPORTES__MOTOR'],];
$elemento = array_merge(array_slice($elemento, 0, $soport_motor + 39),$nuevas_columnas,array_slice($elemento, $soport_motor + 1) );
}
if ($soport_transmi !== false) { $nuevas_columnas = ['soport_transmi_fallas' => $consulta_fallas[$i]['SOPORTES__TRANSMISION'],];
$elemento = array_merge(array_slice($elemento, 0, $soport_transmi + 40),$nuevas_columnas,array_slice($elemento, $soport_transmi + 1) );
}
$i++;
}
                //dd($res);
                // Obtener las columnas que terminan en "_o"
$columns_o = [
    'aceite_motor_o',
    'refrigerante_o',
    'aceite_hidra_o',
    'hidroven_o',
    'servicio_o',
    'emergencia_o',
    'neu_eje_dir_izq_o',
    'neu_eje_dir_der_o',
    'neu_eje_int_izq_o',
    'neu_eje_int_der_o',
    'neu_eje_motr_izq_o',
    'neu_eje_motr_der_o',
    'bal_eje_dir_izq_o',
    'bal_eje_dir_der_o',
    'bal_eje_int_izq_o',
    'bal_eje_int_der_o',
    'bal_eje_motr_izq_o',
    'bal_eje_motr_der_o',
    'bols_air_eje_dir_izq_o',
    'bols_air_eje_dir_der_o',
    'bols_air_eje_int_izq_o',
    'bols_air_eje_int_der_o',
    'bols_air_eje_motr_izq_o',
    'bols_air_eje_motr_der_o',
    'asiento_conductor_o',
    'asiento_carro1_o',
    'asiento_carro2_o',
    'pasamanos_carro1_o',
    'pasamanos_carro2_o',
    'codigo_display_o',
    'articulacion_o',
    'articulacion_soporte_o',
    'articulacion_granada_o',
    'calibracion_neum_granada_o',
    'eje_dir_izq_o',
    'eje_dir_der_o',
    'eje_inter_izq_o',
    'eje_inter_der_o',
    'eje_motr_izq_o',
    'eje_motr_der_o',
    'susp_eje1_o',
    'susp_eje2_o',
    'susp_eje3_o',
    'tan_drenado_o',
    'tan_chicote_o',
    
    'soport_motor_o',
    'soport_transmi_o',
];
$columns_not_o = [
    'aceite_motor',
    'aceite_motor_lt',
    'refrigerante',
    'refrigerante_lt',
    'aceite_hidra',
    'aceite_hidra_lt',
    'hidroven',
    'hidroven_lt',
    'servicio',
    'servicio_fallas',
    'emergencia',
    'emergencia_fallas',
    'neu_eje_dir_izq',
    'neu_eje_dir_izq_fallas',
    'neu_eje_dir_der',
    'neu_eje_dir_der_fallas',
    'neu_eje_int_izq',
    'neu_eje_int_izq_fallas',
    'neu_eje_int_der',
    'neu_eje_int_der_fallas',
    'neu_eje_motr_izq',
    'neu_eje_motr_izq_fallas',
    'neu_eje_motr_der',
    'neu_eje_motr_der_fallas',
    'bal_eje_dir_izq',
    'bal_eje_dir_izq_fallas',
    'bal_eje_dir_der',
    'bal_eje_dir_der_fallas',
    'bal_eje_int_izq',
    'bal_eje_int_izq_fallas',
    'bal_eje_int_der',
    'bal_eje_int_der_fallas',
    'bal_eje_motr_izq',
    'bal_eje_motr_izq_fallas',
    'bal_eje_motr_der',
    'bal_eje_motr_der_fallas',
    'bols_air_eje_dir_izq',
    'bols_air_eje_dir_izq_fallas',
    'bols_air_eje_dir_der',
    'bols_air_eje_dir_der_fallas',
    'bols_air_eje_int_izq',
    'bols_air_eje_int_izq_fallas',
    'bols_air_eje_int_der',
    'bols_air_eje_int_der_fallas',
    'bols_air_eje_motr_izq',
    'bols_air_eje_motr_izq_fallas',
    'bols_air_eje_motr_der',
    'bols_air_eje_motr_der_fallas',
    'asiento_conductor',
    'asiento_conductor_fallas',
    'asiento_carro1',
    'asiento_carro1_fallas',
    'asiento_carro2',
    'asiento_carro2_fallas',
    'pasamanos_carro1',
    'pasamanos_carro1_fallas',
    'pasamanos_carro2',
    'pasamanos_carro2_fallas',
    'articulacion',
    'articulacion_fallas',
    'articulacion_soporte',
    'articulacion_soporte_fallas',
    'articulacion_granada',
    'articulacion_granada_fallas',
    'calibracion_neum_granada',
    'calibracion_neum_granada_fallas',
    'eje_dir_izq',
    'eje_dir_izq_fallas',
    'eje_dir_der',
    'eje_dir_der_fallas',
    'eje_inter_izq',
    'eje_inter_izq_fallas',
    'eje_inter_der',
    'eje_inter_der_fallas',
    'eje_motr_izq',
    'eje_motr_izq_fallas',
    'eje_motr_der',
    'eje_motr_der_fallas',
    'susp_eje1',
    'susp_eje1_fallas',
    'susp_eje2',
    'susp_eje2_fallas',
    'susp_eje3',
    'susp_eje3_fallas',
    'tan_drenado',
    'tan_drenado_fallas',
    'tan_chicote',
    'tan_chicote_fallas',
    
    'soport_motor',
    'soport_motor_fallas',
    'soport_transmi',
    'soport_transmi_fallas',
];

                // Iterar sobre cada fila del resultado
foreach ($res as &$row) {
                // Iterar sobre cada columna terminada en "_o"
    foreach ($columns_o as $column_o) {
                    // Verificar si la columna está vacía o nula
        if (empty($row[$column_o]) && !is_numeric($row[$column_o])) {
                        // Cambiar el valor por "sin observaciones"
            $row[$column_o] = "S/O";
        }
    }
}
            //dd($res);
$html = view('Transmasivo.Mantenimiento.pdf_liberacion_unidades',compact('res'))->render();
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
return $dompdf->stream('Bitacora de terminales '.now().'.pdf');

}else if($request->has('Exportar_excel')){
           // Decodificar el JSON
    $res = json_decode($request->input('consulta'), true);
    $consulta_fallas = json_decode($request->input('consulta_fallas'), true);
                //dd($consulta_fallas);
    $i=0;

    foreach ($res as &$elemento) {
        $claves = array_keys($elemento);
        $indice = array_search('servicio', $claves);
        $emergencia = array_search('emergencia', $claves);
        $neu_eje_dir_izq = array_search('neu_eje_dir_izq', $claves);
        $neu_eje_dir_der = array_search('neu_eje_dir_der', $claves);
        $neu_eje_int_izq = array_search('neu_eje_int_izq', $claves);
        $neu_eje_int_der = array_search('neu_eje_int_der', $claves);
        $neu_eje_motr_izq = array_search('neu_eje_motr_izq', $claves);
        $neu_eje_motr_der = array_search('neu_eje_motr_der', $claves);
        $bal_eje_dir_izq = array_search('bal_eje_dir_izq', $claves);
        $bal_eje_dir_der = array_search('bal_eje_dir_der', $claves);
        $bal_eje_int_izq = array_search('bal_eje_int_izq', $claves);
        $bal_eje_int_der = array_search('bal_eje_int_der', $claves);
        $bal_eje_motr_izq = array_search('bal_eje_motr_izq', $claves);
        $bal_eje_motr_der = array_search('bal_eje_motr_der', $claves);
        $bols_air_eje_dir_izq = array_search('bols_air_eje_dir_izq', $claves);
        $bols_air_eje_dir_der = array_search('bols_air_eje_dir_der', $claves);
        $bols_air_eje_int_izq = array_search('bols_air_eje_int_izq', $claves);
        $bols_air_eje_int_der = array_search('bols_air_eje_int_der', $claves);
        $bols_air_eje_motr_izq = array_search('bols_air_eje_motr_izq', $claves);
        $bols_air_eje_motr_der = array_search('bols_air_eje_motr_der', $claves);
        $asiento_conductor = array_search('asiento_conductor', $claves);
        $asiento_carro1 = array_search('asiento_carro1', $claves);
        $asiento_carro2 = array_search('asiento_carro2', $claves);
        $articulacion = array_search('articulacion', $claves);
        $articulacion_soporte = array_search('articulacion_soporte', $claves);
        $articulacion_granada = array_search('articulacion_granada', $claves);
        $calibracion_neum_granada = array_search('calibracion_neum_granada', $claves);
        $eje_dir_izq = array_search('eje_dir_izq', $claves);
        $eje_dir_der = array_search('eje_dir_der', $claves);
        $eje_inter_izq = array_search('eje_inter_izq', $claves);
        $eje_inter_der = array_search('eje_inter_der', $claves);
        $eje_motr_izq = array_search('eje_motr_izq', $claves);
        $eje_motr_der = array_search('eje_motr_der', $claves);
        $susp_eje1 = array_search('susp_eje1', $claves);
        $susp_eje2 = array_search('susp_eje2', $claves);
        $susp_eje3 = array_search('susp_eje3', $claves);
        $tan_drenado = array_search('tan_drenado', $claves);
        $tan_chicote = array_search('tan_chicote', $claves);
        $soport_motor = array_search('soport_motor', $claves);
        $soport_transmi = array_search('soport_transmi', $claves);
        
        if ($indice !== false) {
            $nuevas_columnas = ['servicio_fallas' => $consulta_fallas[$i]['Puertas__SERVICIO'],];
            $elemento = array_merge(array_slice($elemento, 0, $indice + 1),$nuevas_columnas,array_slice($elemento, $indice + 1));
        }
        if ($emergencia !== false) { $nuevas_columnas = ['emergencia_fallas' => $consulta_fallas[$i]['Puertas__EMERGENCIA'],];
        $elemento = array_merge(array_slice($elemento, 0, $emergencia + 2),$nuevas_columnas,array_slice($elemento, $emergencia + 1) );
    }
    if ($neu_eje_dir_izq !== false) { $nuevas_columnas = ['neu_eje_dir_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO'],];
    $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_izq + 3),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_izq + 1) );
}
if ($neu_eje_dir_der !== false) { $nuevas_columnas = ['neu_eje_dir_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_der + 4),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_der + 1) );
}
if ($neu_eje_int_izq !== false) { $nuevas_columnas = ['neu_eje_int_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_izq + 5),$nuevas_columnas,array_slice($elemento, $neu_eje_int_izq + 1) );
}
if ($neu_eje_int_der !== false) { $nuevas_columnas = ['neu_eje_int_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_der + 6),$nuevas_columnas,array_slice($elemento, $neu_eje_int_der + 1) );
}
if ($neu_eje_motr_izq !== false) { $nuevas_columnas = ['neu_eje_motr_izq_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_izq + 7),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_izq + 1) );
}
if ($neu_eje_motr_der !== false) { $nuevas_columnas = ['neu_eje_motr_der_fallas' => $consulta_fallas[$i]['NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_der + 8),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_der + 1) );
}
if ($bal_eje_dir_izq !== false) { $nuevas_columnas = ['bal_eje_dir_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_izq + 9),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_izq + 1) );
}
if ($bal_eje_dir_der !== false) { $nuevas_columnas = ['bal_eje_dir_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_der + 10),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_der + 1) );
}
if ($bal_eje_int_izq !== false) { $nuevas_columnas = ['bal_eje_int_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_izq + 11),$nuevas_columnas,array_slice($elemento, $bal_eje_int_izq + 1) );
}
if ($bal_eje_int_der !== false) { $nuevas_columnas = ['bal_eje_int_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_der + 12),$nuevas_columnas,array_slice($elemento, $bal_eje_int_der + 1) );
}
if ($bal_eje_motr_izq !== false) { $nuevas_columnas = ['bal_eje_motr_izq_fallas' => $consulta_fallas[$i]['BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_izq + 13),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_izq + 1) );
}
if ($bal_eje_motr_der !== false) { $nuevas_columnas = ['bal_eje_motr_der_fallas' => $consulta_fallas[$i]['BALATAS_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_der + 14),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_der + 1) );
}
if ($bols_air_eje_dir_izq !== false) { $nuevas_columnas = ['bols_air_eje_dir_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_izq + 15),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_izq + 1) );
}
if ($bols_air_eje_dir_der !== false) { $nuevas_columnas = ['bols_air_eje_dir_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_der + 16),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_der + 1) );
}
if ($bols_air_eje_int_izq !== false) { $nuevas_columnas = ['bols_air_eje_int_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_izq + 17),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_izq + 1) );
}
if ($bols_air_eje_int_der !== false) { $nuevas_columnas = ['bols_air_eje_int_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_der + 18),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_der + 1) );
}
if ($bols_air_eje_motr_izq !== false) { $nuevas_columnas = ['bols_air_eje_motr_izq_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_izq + 19),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_izq + 1) );
}
if ($bols_air_eje_motr_der !== false) { $nuevas_columnas = ['bols_air_eje_motr_der_fallas' => $consulta_fallas[$i]['BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_der + 20),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_der + 1) );
}
if ($asiento_conductor !== false) { $nuevas_columnas = ['asiento_conductor_fallas' => $consulta_fallas[$i]['ASIENTOS__CONDUCTOR'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_conductor + 21),$nuevas_columnas,array_slice($elemento, $asiento_conductor + 1) );
}
if ($asiento_carro1 !== false) { $nuevas_columnas = ['asiento_carro1_fallas' => $consulta_fallas[$i]['ASIENTOS__CARRO_1'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro1 + 22),$nuevas_columnas,array_slice($elemento, $asiento_carro1 + 1) );
}
if ($asiento_carro2 !== false) { $nuevas_columnas = ['asiento_carro2_fallas' => $consulta_fallas[$i]['ASIENTOS__CARRO_2'],];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro2 + 23),$nuevas_columnas,array_slice($elemento, $asiento_carro2 + 1) );
}
if ($articulacion !== false) { $nuevas_columnas = ['articulacion_fallas' => $consulta_fallas[$i]['ARTICULACION__ARTICULACION'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion + 24),$nuevas_columnas,array_slice($elemento, $articulacion + 1) );
}
if ($articulacion_soporte !== false) { $nuevas_columnas = ['articulacion_soporte_fallas' => $consulta_fallas[$i]['ARTICULACION__SOPORTE'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_soporte + 25),$nuevas_columnas,array_slice($elemento, $articulacion_soporte + 1) );
}
if ($articulacion_granada !== false) { $nuevas_columnas = ['articulacion_granada_fallas' => $consulta_fallas[$i]['ARTICULACION__GRANADAS'],];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_granada + 26),$nuevas_columnas,array_slice($elemento, $articulacion_granada + 1) );
}
if ($calibracion_neum_granada !== false) { $nuevas_columnas = ['calibracion_neum_granada_fallas' => $consulta_fallas[$i]['CALIBRACION_DE_NEUMATICOS__GRANADAS'],];
$elemento = array_merge(array_slice($elemento, 0, $calibracion_neum_granada + 27),$nuevas_columnas,array_slice($elemento, $calibracion_neum_granada + 1) );
}
if ($eje_dir_izq !== false) { $nuevas_columnas = ['eje_dir_izq_fallas' => $consulta_fallas[$i]['EJE_DIRECCIONAL__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_izq + 28),$nuevas_columnas,array_slice($elemento, $eje_dir_izq + 1) );
}
if ($eje_dir_der !== false) { $nuevas_columnas = ['eje_dir_der_fallas' => $consulta_fallas[$i]['EJE_DIRECCIONAL__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_der + 29),$nuevas_columnas,array_slice($elemento, $eje_dir_der + 1) );
}
if ($eje_inter_izq !== false) { $nuevas_columnas = ['eje_inter_izq_fallas' => $consulta_fallas[$i]['EJE_INTERMEDIO__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_izq + 30),$nuevas_columnas,array_slice($elemento, $eje_inter_izq + 1) );
}
if ($eje_inter_der !== false) { $nuevas_columnas = ['eje_inter_der_fallas' => $consulta_fallas[$i]['EJE_INTERMEDIO__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_der + 31),$nuevas_columnas,array_slice($elemento, $eje_inter_der + 1) );
}
if ($eje_motr_izq !== false) { $nuevas_columnas = ['eje_motr_izq_fallas' => $consulta_fallas[$i]['EJE_MOTRIZ__LADO_IZQUIERDO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_izq + 32),$nuevas_columnas,array_slice($elemento, $eje_motr_izq + 1) );
}
if ($eje_motr_der !== false) { $nuevas_columnas = ['eje_motr_der_fallas' => $consulta_fallas[$i]['EJE_MOTRIZ__LADO_DERECHO'],];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_der + 33),$nuevas_columnas,array_slice($elemento, $eje_motr_der + 1) );
}
if ($susp_eje1 !== false) { $nuevas_columnas = ['susp_eje1_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_1'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje1 + 34),$nuevas_columnas,array_slice($elemento, $susp_eje1 + 1) );
}
if ($susp_eje2 !== false) { $nuevas_columnas = ['susp_eje2_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_2'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje2 + 35),$nuevas_columnas,array_slice($elemento, $susp_eje2 + 1) );
}
if ($susp_eje3 !== false) { $nuevas_columnas = ['susp_eje3_fallas' => $consulta_fallas[$i]['SUSPENCION__EJE_3'],];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje3 + 36),$nuevas_columnas,array_slice($elemento, $susp_eje3 + 1) );
}
if ($tan_drenado !== false) { $nuevas_columnas = ['tan_drenado_fallas' => $consulta_fallas[$i]['TANQUE__DRENADO'],];
$elemento = array_merge(array_slice($elemento, 0, $tan_drenado + 37),$nuevas_columnas,array_slice($elemento, $tan_drenado + 1) );
} 
if ($tan_chicote !== false) { $nuevas_columnas = ['tan_chicote_fallas' => $consulta_fallas[$i]['TANQUE__CHICOTES'],];
$elemento = array_merge(array_slice($elemento, 0, $tan_chicote + 38),$nuevas_columnas,array_slice($elemento, $tan_chicote + 1) );
}
if ($soport_motor !== false) { $nuevas_columnas = ['soport_motor_fallas' => $consulta_fallas[$i]['SOPORTES__MOTOR'],];
$elemento = array_merge(array_slice($elemento, 0, $soport_motor + 39),$nuevas_columnas,array_slice($elemento, $soport_motor + 1) );
}
if ($soport_transmi !== false) { $nuevas_columnas = ['soport_transmi_fallas' => $consulta_fallas[$i]['SOPORTES__TRANSMISION'],];
$elemento = array_merge(array_slice($elemento, 0, $soport_transmi + 40),$nuevas_columnas,array_slice($elemento, $soport_transmi + 1) );
}
$i++;
}
                //dd($res);
                // Obtener las columnas que terminan en "_o"
$columns_o = [
    'aceite_motor_o',
    'refrigerante_o',
    'aceite_hidra_o',
    'hidroven_o',
    'servicio_o',
    'emergencia_o',
    'neu_eje_dir_izq_o',
    'neu_eje_dir_der_o',
    'neu_eje_int_izq_o',
    'neu_eje_int_der_o',
    'neu_eje_motr_izq_o',
    'neu_eje_motr_der_o',
    'bal_eje_dir_izq_o',
    'bal_eje_dir_der_o',
    'bal_eje_int_izq_o',
    'bal_eje_int_der_o',
    'bal_eje_motr_izq_o',
    'bal_eje_motr_der_o',
    'bols_air_eje_dir_izq_o',
    'bols_air_eje_dir_der_o',
    'bols_air_eje_int_izq_o',
    'bols_air_eje_int_der_o',
    'bols_air_eje_motr_izq_o',
    'bols_air_eje_motr_der_o',
    'asiento_conductor_o',
    'asiento_carro1_o',
    'asiento_carro2_o',
    'pasamanos_carro1_o',
    'pasamanos_carro2_o',
    'codigo_display_o',
    'articulacion_o',
    'articulacion_soporte_o',
    'articulacion_granada_o',
    'calibracion_neum_granada_o',
    'eje_dir_izq_o',
    'eje_dir_der_o',
    'eje_inter_izq_o',
    'eje_inter_der_o',
    'eje_motr_izq_o',
    'eje_motr_der_o',
    'susp_eje1_o',
    'susp_eje2_o',
    'susp_eje3_o',
    'tan_drenado_o',
    'tan_chicote_o',
    'soport_motor_o',
    'soport_transmi_o',
];
$columns_not_o = [
    'aceite_motor',
    'aceite_motor_lt',
    'refrigerante',
    'refrigerante_lt',
    'aceite_hidra',
    'aceite_hidra_lt',
    'hidroven',
    'hidroven_lt',
    'servicio',
    'servicio_fallas',
    'emergencia',
    'emergencia_fallas',
    'neu_eje_dir_izq',
    'neu_eje_dir_izq_fallas',
    'neu_eje_dir_der',
    'neu_eje_dir_der_fallas',
    'neu_eje_int_izq',
    'neu_eje_int_izq_fallas',
    'neu_eje_int_der',
    'neu_eje_int_der_fallas',
    'neu_eje_motr_izq',
    'neu_eje_motr_izq_fallas',
    'neu_eje_motr_der',
    'neu_eje_motr_der_fallas',
    'bal_eje_dir_izq',
    'bal_eje_dir_izq_fallas',
    'bal_eje_dir_der',
    'bal_eje_dir_der_fallas',
    'bal_eje_int_izq',
    'bal_eje_int_izq_fallas',
    'bal_eje_int_der',
    'bal_eje_int_der_fallas',
    'bal_eje_motr_izq',
    'bal_eje_motr_izq_fallas',
    'bal_eje_motr_der',
    'bal_eje_motr_der_fallas',
    'bols_air_eje_dir_izq',
    'bols_air_eje_dir_izq_fallas',
    'bols_air_eje_dir_der',
    'bols_air_eje_dir_der_fallas',
    'bols_air_eje_int_izq',
    'bols_air_eje_int_izq_fallas',
    'bols_air_eje_int_der',
    'bols_air_eje_int_der_fallas',
    'bols_air_eje_motr_izq',
    'bols_air_eje_motr_izq_fallas',
    'bols_air_eje_motr_der',
    'bols_air_eje_motr_der_fallas',
    'asiento_conductor',
    'asiento_conductor_fallas',
    'asiento_carro1',
    'asiento_carro1_fallas',
    'asiento_carro2',
    'asiento_carro2_fallas',
    'pasamanos_carro1',
    'pasamanos_carro1_fallas',
    'pasamanos_carro2',
    'pasamanos_carro2_fallas',
    'articulacion',
    'articulacion_fallas',
    'articulacion_soporte',
    'articulacion_soporte_fallas',
    'articulacion_granada',
    'articulacion_granada_fallas',
    'calibracion_neum_granada',
    'calibracion_neum_granada_fallas',
    'eje_dir_izq',
    'eje_dir_izq_fallas',
    'eje_dir_der',
    'eje_dir_der_fallas',
    'eje_inter_izq',
    'eje_inter_izq_fallas',
    'eje_inter_der',
    'eje_inter_der_fallas',
    'eje_motr_izq',
    'eje_motr_izq_fallas',
    'eje_motr_der',
    'eje_motr_der_fallas',
    'susp_eje1',
    'susp_eje1_fallas',
    'susp_eje2',
    'susp_eje2_fallas',
    'susp_eje3',
    'susp_eje3_fallas',
    'tan_drenado',
    'tan_drenado_fallas',
    'tan_chicote',
    'tan_chicote_fallas',
    'soport_motor',
    'soport_motor_fallas',
    'soport_transmi',
    'soport_transmi_fallas',
];

                // Iterar sobre cada fila del resultado
foreach ($res as &$row) {
                // Iterar sobre cada columna terminada en "_o"
    foreach ($columns_o as $column_o) {
                    // Verificar si la columna está vacía o nula
        if (empty($row[$column_o]) && !is_numeric($row[$column_o])) {
                        // Cambiar el valor por "sin observaciones"
            $row[$column_o] = "S/O";
        }
    }
}






return Excel::download(new bitacoraMantenimiento($res), 'reporte_liberacion_de_unidades'.now().'.xlsx');
} else {
    $n_economico=$request->input('n_economico');
    $n_mecanico=$request->input('n_mecanico');
    $nom_supervisor=$request->input('nom_supervisor');
    $km=$request->input('km');
    $bares=$request->input('bares');
    $del=$request->input('del');
    $al=$request->input('al');
    $tipo_informe=$request->input('tipo_informe');
    
    
    $query = BitacoraLiberacionUnidades::query();

    if ($n_economico !== null) {
        $query->where('n_economico', $n_economico);
    }

    if ($del !== null && $al !== null) {
        $query->whereBetween('Fecha', [$del, $al]);
    }
    
    if ($n_mecanico !== '-Selecciona-') {
        $query->where('n_mecanico', $n_mecanico);
    }
    
    if ($nom_supervisor !== '-Selecciona-') {
        $query->where('nom_supervisor', $nom_supervisor);
    }
    
    if ($km !== null) {
        $query->where('km', $km);
    }
    if ($tipo_informe !== '-Selecciona-') {
        $query->where('tipo_informe', $tipo_informe);
    }
    
    if ($bares !== null) {
        $query->where('bares', $bares);
    }
    $consulta_completa="SELECT 
    detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion,bitacora_liberacion_unidades.n_economico,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 5 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS Puertas__SERVICIO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 6 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS Puertas__EMERGENCIA,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 7 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO,
    
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 8 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 9 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 10 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 11 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 12 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 13 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 14 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 15 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 16 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 17 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 18 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BALATAS_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 19 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 20 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 21 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 22 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 23 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 24 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 25 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CONDUCTOR,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 26 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CARRO_1,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 27 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ASIENTOS__CARRO_2,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 28 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS CÓDIGO_EN_DISPLAY,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 29 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__ARTICULACION,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 30 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__SOPORTE,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 31 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS ARTICULACION__GRANADAS,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 32 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS CALIBRACION_DE_NEUMATICOS__GRANADAS,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 33 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_DIRECCIONAL__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 34 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_DIRECCIONAL__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 35 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_INTERMEDIO__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 36 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_INTERMEDIO__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 37 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_MOTRIZ__LADO_IZQUIERDO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 38 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS EJE_MOTRIZ__LADO_DERECHO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 39 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_1,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 40 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_2,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 41 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SUSPENCION__EJE_3,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 42 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS TANQUE__DRENADO,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 46 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS TANQUE__CHICOTES,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 43 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SOPORTES__MOTOR,
    GROUP_CONCAT(
        CASE WHEN c_fallas_subseccion_liberacion_unidades.id_subseccion = 44 THEN c_fallas_subseccion_liberacion_unidades.falla END
        ORDER BY c_fallas_subseccion_liberacion_unidades.falla ASC
        SEPARATOR ', '
        ) AS SOPORTES__TRANSMISION
    
    
    FROM 
    detalle_falla_bitacora_liberacion_unidades
    INNER JOIN 
    c_fallas_subseccion_liberacion_unidades ON c_fallas_subseccion_liberacion_unidades.id_fallas_subseccion_liberacion_unidades = detalle_falla_bitacora_liberacion_unidades.id_c_fallas INNER JOIN 
    bitacora_liberacion_unidades ON detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion = bitacora_liberacion_unidades.id_bitacora_liberacion_unidades

    WHERE ";
    
    $where_completa="";
    if ($n_economico !== null) {
        $where_completa.= ' bitacora_liberacion_unidades.n_economico='.$n_economico .' and';
    }

    if ($n_mecanico !== '-Selecciona-') {
        
        $where_completa.= ' bitacora_liberacion_unidades.n_mecanico="'.$n_mecanico .'" and';
    }

    if ($del  !== null && $al  !== null) {
        
        $where_completa.= ' bitacora_liberacion_unidades.Fecha between "'.$del .'" and "'.$al .'" and';
    }

    if ($nom_supervisor !== '-Selecciona-') {
        
        $where_completa.= ' bitacora_liberacion_unidades.nom_supervisor="'.$nom_supervisor .'" and';
    }

    if ($km !== null) {
        $where_completa.= ' bitacora_liberacion_unidades.km='.$km .' and';
    }

    if ($bares !== null) {
        
        $where_completa.= ' bitacora_liberacion_unidades.bares='.$bares .' and';
    }



    $where_completa.= ' id_bitacora_liberacion > 0 ';
    $consulta_completa.=$where_completa;
    $consulta_completa.=" GROUP BY 
     
    bitacora_liberacion_unidades.n_economico,
    detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion; ";
    $consulta = $query->get();
    $consulta_fallas = DB::connection('mysql')->select($consulta_completa);
            //dd($consulta_fallas);
            //return $consulta;
            //dd($consulta);

    $mensaje="Datos encontrados";
    $color="success";
    if(count($consulta)==0)
    {
        $mensaje="No se encontraron datos";
        $color="danger";
    }

    
    return redirect()->route('Consulta_bitacora')
    ->with('mensaje', $mensaje)
    ->with('color', $color)
    ->with('n_economico', $n_economico)
    ->with('n_mecanico', $n_mecanico)
    ->with('nom_supervisor', $nom_supervisor)
    ->with('km', $km)
    ->with('bares', $bares)
    ->with('del', $del)
    ->with('al', $al)
    ->with('consulta', $consulta)->with('consulta_fallas', $consulta_fallas)->with('consulta_fallas2', json_encode($consulta_fallas))->with('consulta2', json_encode($consulta));
}

}

public function Alta_de_unidades()
{
    $marcas = new Marca_flota;
    $con=$marcas->get();
    return view('Transmasivo.Mantenimiento.Alta_unidades',compact('con'));
}
public function Registro_de_unidades(Request $request)
{
    $flota = new Flota;

    date_default_timezone_set('America/Mexico_City');
    $hora_actual = time();

    $hora_una_hora_atras = $hora_actual - 3600;

    $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        // Asignar los valores recibidos del formulario a los campos del modelo
    $flota->num_economico = $request->input('n_economico');
    $flota->marca_flota = $request->input('marca');
    $flota->km = $request->input('km');
    $flota->bares = $request->input('bares');
    $flota->fecha_creacion = $hora_formateada;
    $flota->save();

    $mensaje="Se registro con exito!";
    $color="success";
    return redirect()->route('Alta_de_unidades')->with('mensaje', $mensaje)->with('color', $color);
}

public function Reporte_de_supervisión($consulta="")
{
    $empresas = DB::connection('mysql_produc')->select('select * from cempresas');
    $personal = DB::connection('mysql_produc')->select('select * from cpersonal');
    $fallos = DB::connection('mysql_produc')->select('select * from cdescfallo');
    $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo asc');
    return view('Transmasivo.Mantenimiento.Reporte_de_supervisión',compact('empresas','unidades','personal','fallos','consulta'));
}
public function post_Reporte_de_supervisión(Request $request)
{
    if($request->has('Consultar'))
    {
        $Folio = $request->input('Folio');
        $Empresa = $request->input('Empresa');
        $Unidad = $request->input('Unidad');
        $Usuario = $request->input('Usuario');
        $Estatus = $request->input('Estatus');
        $Mes = $request->input('Mes');
        $Subgrupo = $request->input('Subgrupo');
        $De = $request->input('De');
        $Hasta = $request->input('Hasta');
            //dd($request->all());
        $select="select reportesupervicion.*,CONCAT (cpersonal.nombres,' ',cpersonal.ApPaterno,' ',cpersonal.ApMaterno ) AS supervisor from reportesupervicion
        INNER JOIN cpersonal ON cpersonal.idPersona=reportesupervicion.SupervisorfkCPersonal
        where ";
        if($Folio !== null)
        {
            $select.= " Folio='".$Folio."' and ";
        }
        if($Empresa !== '-Selecciona-')
        {
            $select.= " Folio='".$Empresa."' and ";
        }
        if($Unidad !== '-Selecciona-')
        {
            $select.= " UnidadfkCUnidades='".$Unidad."' and ";
        }
        if($Usuario !== '-Selecciona-')
        {
            $select.= " SupervisorfkCPersonal='".$Usuario."' and ";
        }
        if($Subgrupo !== '-Selecciona-')
        {
            $select.= " DescrFallofkcdescfallo='".$Subgrupo."' and ";
        }
        if($De !== null || $Hasta !== null)
        {
            $select.= " fechaReporte between '".$De."' and '".$Hasta."' and";
        }
        $select.= " idReporteSupervicion > 0  ";
        $consulta=DB::connection('mysql_produc')->select($select);
        
        return $this->Reporte_de_supervisión($consulta);
    }
}

public function Liberacion_unidades_electrico($mensaje="", $color="")
{
    $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
    $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
    return view('Transmasivo.MantenimientoElectrico.Liberacion_unidades_electrico',compact('unidades','mecanicos','mensaje','color'));
}

public function registro_Liberacion_unidades_electrico(Request $request)
{
       // dd($request->all());

    date_default_timezone_set('America/Mexico_City');
    $hora_actual = time();
    $hora_una_hora_atras = $hora_actual - 3600;
    $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
    $bitacora = new BitacoraLiberacionUnidadesElectrico;

    $km = $request->input('km');
    $km = str_replace(',', '', $km);
    
    $bitacora->n_economico = $request->input('n_economico');
    $bitacora->fecha_hora = $hora_formateada;
    $bitacora->n_mecanico = $request->input('n_mecanico');
    $bitacora->n_supervisor = $request->input('n_supervisor');
    $bitacora->fecha = $request->input('Fecha');
    $bitacora->km = $km ;
    $bitacora->luc_ext_ilu_fron_far_izq = $request->input('luc_ext_ilu_fron_far_izq');
    $bitacora->luc_ext_ilu_fron_far_izq_o = $request->input('luc_ext_ilu_fron_far_izq_o');
    $bitacora->luc_ext_ilu_fron_luc_baj_izq = $request->input('luc_ext_ilu_fron_luc_baj_izq');
    $bitacora->luc_ext_ilu_fron_luc_baj_izq_o = $request->input('luc_ext_ilu_fron_luc_baj_izq_o');
    $bitacora->luc_ext_ilu_fron_luc_alt_izq = $request->input('luc_ext_ilu_fron_luc_alt_izq');
    $bitacora->luc_ext_ilu_fron_luc_alt_izq_o = $request->input('luc_ext_ilu_fron_luc_alt_izq_o');
    $bitacora->luc_ext_ilu_fron_inter_izq = $request->input('luc_ext_ilu_fron_inter_izq');
    $bitacora->luc_ext_ilu_fron_inter_izq_o = $request->input('luc_ext_ilu_fron_inter_izq_o');
    $bitacora->luc_ext_ilu_fron_torr_izq = $request->input('luc_ext_ilu_fron_torr_izq');
    $bitacora->luc_ext_ilu_fron_torr_izq_o = $request->input('luc_ext_ilu_fron_torr_izq_o');
    $bitacora->luc_ext_ilu_fron_estro_izq = $request->input('luc_ext_ilu_fron_estro_izq');
    $bitacora->luc_ext_ilu_fron_estro_izq_o = $request->input('luc_ext_ilu_fron_estro_izq_o');
    $bitacora->luc_ext_ilu_fron_nebl_izq = $request->input('luc_ext_ilu_fron_nebl_izq');
    $bitacora->luc_ext_ilu_fron_nebl_izq_o = $request->input('luc_ext_ilu_fron_nebl_izq_o');
    $bitacora->luc_ext_ilu_fron_plaf_izq = $request->input('luc_ext_ilu_fron_plaf_izq');
    $bitacora->luc_ext_ilu_fron_plaf_izq_o = $request->input('luc_ext_ilu_fron_plaf_izq_o');
    $bitacora->luc_ext_ilu_fron_sopor_faro_izq = $request->input('luc_ext_ilu_fron_sopor_faro_izq');
    $bitacora->luc_ext_ilu_fron_sopor_faro_izq_o = $request->input('luc_ext_ilu_fron_sopor_faro_izq_o');
    $bitacora->luc_ext_ilu_fron_far_der = $request->input('luc_ext_ilu_fron_far_der');
    $bitacora->luc_ext_ilu_fron_far_der_o = $request->input('luc_ext_ilu_fron_far_der_o');
    $bitacora->luc_ext_ilu_fron_luc_baj_der = $request->input('luc_ext_ilu_fron_luc_baj_der');
    $bitacora->luc_ext_ilu_fron_luc_baj_der_o = $request->input('luc_ext_ilu_fron_luc_baj_der_o');
    $bitacora->luc_ext_ilu_fron_luc_alt_der = $request->input('luc_ext_ilu_fron_luc_alt_der');
    $bitacora->luc_ext_ilu_fron_luc_alt_der_o = $request->input('luc_ext_ilu_fron_luc_alt_der_o');
    $bitacora->luc_ext_ilu_fron_inter_der = $request->input('luc_ext_ilu_fron_inter_der');
    $bitacora->luc_ext_ilu_fron_inter_der_o = $request->input('luc_ext_ilu_fron_inter_der_o');
    $bitacora->luc_ext_ilu_fron_torr_der = $request->input('luc_ext_ilu_fron_torr_der');
    $bitacora->luc_ext_ilu_fron_torr_der_o = $request->input('luc_ext_ilu_fron_torr_der_o');
    $bitacora->luc_ext_ilu_fron_estro_der = $request->input('luc_ext_ilu_fron_estro_der');
    $bitacora->luc_ext_ilu_fron_estro_der_o = $request->input('luc_ext_ilu_fron_estro_der_o');
    $bitacora->luc_ext_ilu_fron_nebl_der = $request->input('luc_ext_ilu_fron_nebl_der');
    $bitacora->luc_ext_ilu_fron_nebl_der_o = $request->input('luc_ext_ilu_fron_nebl_der_o');
    $bitacora->luc_ext_ilu_fron_plaf_der = $request->input('luc_ext_ilu_fron_plaf_der');
    $bitacora->luc_ext_ilu_fron_plaf_der_o = $request->input('luc_ext_ilu_fron_plaf_der_o');
    $bitacora->luc_ext_ilu_fron_sopor_faro_der = $request->input('luc_ext_ilu_fron_sopor_faro_der');
    $bitacora->luc_ext_ilu_fron_sopor_faro_der_o = $request->input('luc_ext_ilu_fron_sopor_faro_der_o');
    $bitacora->lat_pri_carr_plaf_inf_izq = $request->input('lat_pri_carr_plaf_inf_izq');
    $bitacora->lat_pri_carr_plaf_inf_izq_o = $request->input('lat_pri_carr_plaf_inf_izq_o');
    $bitacora->lat_pri_carr_plaf_inf_der = $request->input('lat_pri_carr_plaf_inf_der');
    $bitacora->lat_pri_carr_plaf_inf_der_o = $request->input('lat_pri_carr_plaf_inf_der_o');
    $bitacora->lat_pri_carr_plaf_sup_izq = $request->input('lat_pri_carr_plaf_sup_izq');
    $bitacora->lat_pri_carr_plaf_sup_izq_o = $request->input('lat_pri_carr_plaf_sup_izq_o');
    $bitacora->lat_pri_carr_plaf_sup_der = $request->input('lat_pri_carr_plaf_sup_der');
    $bitacora->lat_pri_carr_plaf_sup_der_o = $request->input('lat_pri_carr_plaf_sup_der_o');
    $bitacora->lat_seg_carr_plaf_inf_izq = $request->input('lat_seg_carr_plaf_inf_izq');
    $bitacora->lat_seg_carr_plaf_inf_izq_o = $request->input('lat_seg_carr_plaf_inf_izq_o');
    $bitacora->lat_seg_carr_plaf_inf_der = $request->input('lat_seg_carr_plaf_inf_der');
    $bitacora->lat_seg_carr_plaf_inf_der_o = $request->input('lat_seg_carr_plaf_inf_der_o');
    $bitacora->lat_seg_carr_plaf_sup_izq = $request->input('lat_seg_carr_plaf_sup_izq');
    $bitacora->lat_seg_carr_plaf_sup_izq_o = $request->input('lat_seg_carr_plaf_sup_izq_o');
    $bitacora->lat_seg_carr_plaf_sup_der = $request->input('lat_seg_carr_plaf_sup_der');
    $bitacora->lat_seg_carr_plaf_sup_der_o = $request->input('lat_seg_carr_plaf_sup_der_o');
    $bitacora->ilu_tras_cala_izq = $request->input('ilu_tras_cala_izq');
    $bitacora->ilu_tras_cala_izq_o = $request->input('ilu_tras_cala_izq_o');
    $bitacora->ilu_tras_cala_der = $request->input('ilu_tras_cala_der');
    $bitacora->ilu_tras_cala_der_o = $request->input('ilu_tras_cala_der_o');
    $bitacora->ilu_tras_stop_izq = $request->input('ilu_tras_stop_izq');
    $bitacora->ilu_tras_stop_izq_o = $request->input('ilu_tras_stop_izq_o');
    $bitacora->ilu_tras_stop_der = $request->input('ilu_tras_stop_der');
    $bitacora->ilu_tras_stop_der_o = $request->input('ilu_tras_stop_der_o');
    $bitacora->ilu_tras_rever_izq = $request->input('ilu_tras_rever_izq');
    $bitacora->ilu_tras_rever_izq_o = $request->input('ilu_tras_rever_izq_o');
    $bitacora->ilu_tras_rever_der = $request->input('ilu_tras_rever_der');
    $bitacora->ilu_tras_rever_der_o = $request->input('ilu_tras_rever_der_o');
    $bitacora->ilu_tras_inter_izq = $request->input('ilu_tras_inter_izq');
    $bitacora->ilu_tras_inter_izq_o = $request->input('ilu_tras_inter_izq_o');
    $bitacora->ilu_tras_inter_der = $request->input('ilu_tras_inter_der');
    $bitacora->ilu_tras_inter_der_o = $request->input('ilu_tras_inter_der_o');
    $bitacora->ilu_tras_sop_cala_izq = $request->input('ilu_tras_sop_cala_izq');
    $bitacora->ilu_tras_sop_cala_izq_o = $request->input('ilu_tras_sop_cala_izq_o');
    $bitacora->ilu_tras_sop_cala_der = $request->input('ilu_tras_sop_cala_der');
    $bitacora->ilu_tras_sop_cala_der_o = $request->input('ilu_tras_sop_cala_der_o');
    $bitacora->luc_int_luc_cond = $request->input('luc_int_luc_cond');
    $bitacora->luc_int_luc_cond_o = $request->input('luc_int_luc_cond_o');
    $bitacora->luc_int_letr_rut = $request->input('luc_int_letr_rut');
    $bitacora->luc_int_letr_rut_o = $request->input('luc_int_letr_rut_o');
    $bitacora->luc_int_letr_5_seg = $request->input('luc_int_letr_5_seg');
    $bitacora->luc_int_letr_5_seg_o = $request->input('luc_int_letr_5_seg_o');
    $bitacora->luc_int_luc_puer = $request->input('luc_int_luc_puer');
    $bitacora->luc_int_luc_puer_o = $request->input('luc_int_luc_puer_o');
    $bitacora->luc_pasi_pri_carr_pri_paso_izq = $request->input('luc_pasi_pri_carr_pri_paso_izq');
    $bitacora->luc_pasi_pri_carr_pri_paso_izq_o = $request->input('luc_pasi_pri_carr_pri_paso_izq_o');
    $bitacora->luc_pasi_pri_carr_pri_paso_der = $request->input('luc_pasi_pri_carr_pri_paso_der');
    $bitacora->luc_pasi_pri_carr_pri_paso_der_o = $request->input('luc_pasi_pri_carr_pri_paso_der_o');
    $bitacora->luc_pasi_pri_carr_seg_paso_izq = $request->input('luc_pasi_pri_carr_seg_paso_izq');
    $bitacora->luc_pasi_pri_carr_seg_paso_izq_o = $request->input('luc_pasi_pri_carr_seg_paso_izq_o');
    $bitacora->luc_pasi_pri_carr_seg_paso_der = $request->input('luc_pasi_pri_carr_seg_paso_der');
    $bitacora->luc_pasi_pri_carr_seg_paso_der_o = $request->input('luc_pasi_pri_carr_seg_paso_der_o');
    $bitacora->luc_pasi_seg_carr_pri_paso_izq = $request->input('luc_pasi_seg_carr_pri_paso_izq');
    $bitacora->luc_pasi_seg_carr_pri_paso_izq_o = $request->input('luc_pasi_seg_carr_pri_paso_izq_o');
    $bitacora->luc_pasi_seg_carr_pri_paso_der = $request->input('luc_pasi_seg_carr_pri_paso_der');
    $bitacora->luc_pasi_seg_carr_pri_paso_der_o = $request->input('luc_pasi_seg_carr_pri_paso_der_o');
    $bitacora->luc_pasi_seg_carr_seg_paso_izq = $request->input('luc_pasi_seg_carr_seg_paso_izq');
    $bitacora->luc_pasi_seg_carr_seg_paso_izq_o = $request->input('luc_pasi_seg_carr_seg_paso_izq_o');
    $bitacora->luc_pasi_seg_carr_seg_paso_der = $request->input('luc_pasi_seg_carr_seg_paso_der');
    $bitacora->luc_pasi_seg_carr_seg_paso_der_o = $request->input('luc_pasi_seg_carr_seg_paso_der_o');
    $bitacora->alin_alin_luc_baj_izq = $request->input('alin_alin_luc_baj_izq');
    $bitacora->alin_alin_luc_baj_izq_o = $request->input('alin_alin_luc_baj_izq_o');
    $bitacora->alin_alin_luc_baj_der = $request->input('alin_alin_luc_baj_der');
    $bitacora->alin_alin_luc_baj_der_o = $request->input('alin_alin_luc_baj_der_o');
    $bitacora->alin_alin_luc_alt_izq = $request->input('alin_alin_luc_alt_izq');
    $bitacora->alin_alin_luc_alt_izq_o = $request->input('alin_alin_luc_alt_izq_o');
    $bitacora->alin_alin_luc_alt_der = $request->input('alin_alin_luc_alt_der');
    $bitacora->alin_alin_luc_alt_der_o = $request->input('alin_alin_luc_alt_der_o');
    $bitacora->alin_alin_luc_neb_izq = $request->input('alin_alin_luc_neb_izq');
    $bitacora->alin_alin_luc_neb_izq_o = $request->input('alin_alin_luc_neb_izq_o');
    $bitacora->alin_alin_luc_neb_der = $request->input('alin_alin_luc_neb_der');
    $bitacora->alin_alin_luc_neb_der_o = $request->input('alin_alin_luc_neb_der_o');
    $bitacora->inte_inte_luc_baj_izq = $request->input('inte_inte_luc_baj_izq');
    $bitacora->inte_inte_luc_baj_izq_o = $request->input('inte_inte_luc_baj_izq_o');
    $bitacora->inte_inte_luc_baj_der = $request->input('inte_inte_luc_baj_der');
    $bitacora->inte_inte_luc_baj_der_o = $request->input('inte_inte_luc_baj_der_o');
    $bitacora->inte_inte_luc_alt_izq = $request->input('inte_inte_luc_alt_izq');
    $bitacora->inte_inte_luc_alt_izq_o = $request->input('inte_inte_luc_alt_izq_o');
    $bitacora->inte_inte_luc_alt_der = $request->input('inte_inte_luc_alt_der');
    $bitacora->inte_inte_luc_alt_der_o = $request->input('inte_inte_luc_alt_der_o');
    $bitacora->inte_inte_nebl_izq = $request->input('inte_inte_nebl_izq');
    $bitacora->inte_inte_nebl_izq_o = $request->input('inte_inte_nebl_izq_o');
    $bitacora->inte_inte_nebl_der = $request->input('inte_inte_nebl_der');
    $bitacora->inte_inte_nebl_der_o = $request->input('inte_inte_nebl_der_o');
    $bitacora->save();
    $mensaje="Bitacora registrada";
    $color="success";
    
    $mensaje="Se registro con exito!";
    $color="success";
    return redirect()->route('Liberacion_unidades_electrico')->with('mensaje', $mensaje)->with('color', $color);
}

public function Bitacora_Liberacion_unidades_electrico(Request $request)
{
    $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
    $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
    return view('Transmasivo.Mantenimiento.Bitacora_electrica',compact('unidades','mecanicos'));
}

    public function Reporte_de_estado_fisico_y_funcionamiento(Request $request)
    {
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
            INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
        $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
        return view('Transmasivo.Mantenimiento.Bitacora_electrica',compact('unidades','mecanicos'));
    }
}
