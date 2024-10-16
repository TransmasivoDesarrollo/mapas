<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\BitacoraConductores;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\t_bitacora_terminales;
use App\Models\BitacoraLiberacionUnidades;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTime; // Añadir esta línea


use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

class OperacionesController extends Controller
{
    

    public function Bitacora_de_operaciones()
    {
        $consulta = DB::connection('mysql')->select('
            SELECT *,(SELECT COUNT(*)  FROM t_bitacora_terminales t2
                    WHERE t2.credencial = t_bitacora_terminales.credencial and dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
                    AND t2.id_bitacora_terminales <= t_bitacora_terminales.id_bitacora_terminales ) AS posicion
            FROM t_bitacora_terminales INNER JOIN c_terminal   ON c_terminal.id_terminal = t_bitacora_terminales.terminal
            INNER JOIN users   ON users.id = t_bitacora_terminales.credencial
            WHERE dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
            ORDER BY credencial, posicion,  CASE   WHEN TIME(hora_salida) >= "03:00:00" THEN 0    ELSE 1  END,   hora_salida ASC
        ');
        $tr1_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr1_r_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1-R" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr3_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR3" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr4_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR4" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        
        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" AND "' . now()->format('Y-m-d') . ' 23:59:00" GROUP BY credencial, Servicio');
        $credencial = DB::connection('mysql')->select('SELECT * FROM users WHERE tipo_usuario = "Conductor"');
        $terminal = DB::connection('mysql')->select('SELECT * FROM c_terminal');
        $consulta = json_decode(json_encode($consulta), true);
        $credenciales_registradas = json_decode(json_encode($credenciales_registradas), true);
        $diasSemana = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo'
        ];
        $diaActualIngles = date('l'); // Día actual en inglés
        $diaActualEspanol = $diasSemana[$diaActualIngles]; // Día actual traducido al español
        $tr1_ciclos;
        $tr1_r_ciclos;
        $tr3_ciclos;
        $tr4_ciclos;
        $total_ciclos;

       
        //dd($consulta);
        if( $diaActualEspanol=='lunes' ||$diaActualEspanol=='martes' ||$diaActualEspanol=='miercoles' ||$diaActualEspanol=='jueves' ||$diaActualEspanol=='viernes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
           
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='sábado'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='domingo'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');;
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }


        $total_ciclos = $tr1_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr4_ciclos[0]->conteo ; 
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador
        //dd($consulta);
        foreach ($consulta as &$registro) {
            $id_rol_operadores;
                    if( $diaActualEspanol=='lunes' ||$diaActualEspanol=='martes' ||$diaActualEspanol=='miercoles' ||$diaActualEspanol=='jueves' ||$diaActualEspanol=='viernes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes a Viernes"');
                            
                    }
                    if( $diaActualEspanol=='sábado'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Sábado"');
                    }
                    if( $diaActualEspanol=='domingo'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin and dia_servicio="Domingo"');
                    }
                    $jornada  = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_completa_operacion_2 
                        where servicio="'.$id_rol_operadores[0]->servicio.'" and jornada="'.$id_rol_operadores[0]->jornada.'"  
                        and dia_servicio="'.$id_rol_operadores[0]->dia_servicio.'" and turno="'.$id_rol_operadores[0]->turno.'" ');
                    $hora_jornada_lista;
                    $cont=0;
                    foreach($jornada as $jor){
                        $hora_jornada_lista[$cont] = $jor->salida_base;
                        $cont++;
                        $hora_jornada_lista[$cont] = $jor->salida_mitad_recorrido;
                        $cont++;
                    }
                    
                    $posicion = $registro['posicion'] - 1;
                    
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $hora_salida_jornada = 'Fuera de jornada';
                    } else {
                        $hora_salida_jornada = $hora_jornada_lista[$posicion];
                    }
                    $hora_salida_bitacora = $registro['hora_salida'];
                    $registro['hora_salida_rol'] = $hora_salida_jornada;
                    $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                    $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                    if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                        $timestamp_jornada += 86400; // 86400 seconds = 1 day
                    }
                    $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                    $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                    if ($diferencia_segundos < 0) {
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'Sobretiempo';
                    } else if ($diferencia_segundos > 0){
                        $hora_diferencia = '-' . $hora_diferencia;
                        $registro['estatus'] = 'Retardo';
                    }else if($diferencia_segundos == 0)
                    {
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'En tiempo';
                    }
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $registro['hora_diferencia'] = 'Fuera de jornada';
                        $registro['estatus'] = 'Fuera de jornada';
                    } else {
                        $registro['hora_diferencia'] = $hora_diferencia;
                    }
        }
        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        return view('Transmasivo.Operaciones.Bitacora_de_operaciones', 
        compact('terminal','total_registros', 'consulta', 'credencial','tr1_ciclos','tr1_r_ciclos','tr3_ciclos','tr4_ciclos','total_ciclos','tr1_registro','tr1_r_registro','tr3_registro','tr4_registro'));
    }
    

    public function enrolar_horarios_conductores()
    {
        
        $where="";
        $currentYear = \Carbon\Carbon::now()->year;
        $today = \Carbon\Carbon::today()->format('Y-m-d');
        $semanas = [];
        $j = 1;
        $selectedSemana = '';
                $semana_hoy = null; // Variable para almacenar la semana actual

                for ($week = 1; $week <= 52; $week++) {
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                    $semanaValue = "'$startOfWeek 00:00:00' AND '$endOfWeek 23:59:59'";
                    $semanas[] = [
                        'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                        'value' => $semanaValue
                    ];
                    
                    // Verificar si hoy está dentro de esta semana
                    if ($today >= $startOfWeek && $today <= $endOfWeek) {
                        $selectedSemana = $semanaValue;
                        $semana_hoy = [
                            'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                            'value' => $semanaValue
                        ];
                    }
                    
                    $j++;
                }

                $consulta=DB::connection('mysql')->select("SELECT t_rol_operadores.id_rol_operador,t_rol_operadores.servicio,t_rol_operadores.jornada,t_rol_operadores.turno,t_rol_operadores.ciclos,
                    t_rol_operadores.horas,t_rol_operadores.posicion, t_rol_operadores.lunes,t_rol_operadores.martes, t_rol_operadores.miercoles,t_rol_operadores.jueves,t_rol_operadores.viernes,
                    t_rol_operadores.sabado,t_rol_operadores.domingo,
                    CASE
                    WHEN servicio = 'esto es una pruebas' THEN null
                    ELSE NULL
                    END AS id_conductor,
                    CASE
                    WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                    WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                    ELSE NULL
                    END AS total_tiempo,
                    CASE 
                    WHEN lunes = '02:02:02' THEN lunes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS lunes_total,
                    CASE 
                    WHEN martes = '02:02:02' THEN martes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS martes_total,
                    CASE 
                    WHEN miercoles = '02:02:02' THEN miercoles
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS miercoles_total,
                    CASE 
                    WHEN jueves = '02:02:02' THEN jueves
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS jueves_total,
                    CASE 
                    WHEN viernes = '02:02:02' THEN viernes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS viernes_total,
                    CASE 
                    WHEN sabado = '02:02:02' THEN sabado
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS sabado_total,
                    CASE 
                    WHEN domingo = '02:02:02' THEN domingo
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS domingo_total
                    FROM  t_rol_operadores 
                    ;");   
$consulta2 = DB::connection('mysql')->select('select * from t_rol_semanal_conductor 
    inner join users on users.id=t_rol_semanal_conductor.id_conductor
    where fecha_inicio  between '.$semana_hoy['value'].'');
foreach ($consulta as &$item) {
    foreach ($consulta2 as $c2) {
        if ($item->id_rol_operador == $c2->id_rol_operadores) {
            $item->id_conductor = $c2->id . ' - ' . $c2->name;
            break;
        }
    }
}

$conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');

foreach ($conductores as $key => $conductor) {
    foreach ($consulta2 as $c2) {
        if ($conductor->id == $c2->id_conductor) {
            unset($conductores[$key]);
        }
    }
}

$conductores = array_values($conductores);
$semana_seleccionada=$semana_hoy['value'];
$conductores_enrolados = count($consulta2);
$conductores_totales = count($conductores);
return view('Transmasivo.Operaciones.enrolar_horarios_conductores',compact('where','consulta','conductores','conductores_enrolados','conductores_totales','semana_seleccionada'));
}

public function enrolar_horarios_conductores_2($semanas_del_post="")
{
    
    $where="";
    $currentYear = \Carbon\Carbon::now()->year;
    $today = \Carbon\Carbon::today()->format('Y-m-d');
    $semanas = [];
    $j = 1;
    $selectedSemana = '';
    $dia_inicio = '';
    $dia_fin = '';
        $semana_hoy = null; // Variable para almacenar la semana actual

        for ($week = 1; $week <= 52; $week++) {
            $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
            $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
            $semanaValue = "$startOfWeek 00:00:00 al $endOfWeek 23:59:59";
            $semanas[] = [
                'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                'value' => $semanaValue
            ];
            
            if ($today >= $startOfWeek && $today <= $endOfWeek) {
                $selectedSemana = $semanaValue;
                $dia_inicio = $startOfWeek;
                $dia_fin = $endOfWeek;
                $semana_hoy = [
                    'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                    'value' => $semanaValue
                ];
            }
            $j++;
        }

        $jornadas_m = DB::connection('mysql')->select(
            "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
            COUNT(ciclo) AS total_ciclos,
            MIN(CASE 
                WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                ELSE NULL 
                END) AS primera_salida_base,
            MAX(CASE 
                WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                ELSE salida_base
                END) AS ultima_salida_base
            FROM t_jornada_completa_operacion_2
            WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
            AND dia_servicio IN ('Lunes a Viernes')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Lunes a Viernes'), 
            servicio, turno, jornada;"
        );
        $jornadas_s = DB::connection('mysql')->select(
            "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
            COUNT(ciclo) AS total_ciclos,
            MIN(CASE 
                WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                ELSE NULL 
                END) AS primera_salida_base,
            MAX(CASE 
                WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                ELSE salida_base
                END) AS ultima_salida_base
            FROM t_jornada_completa_operacion_2
            WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
            AND dia_servicio IN ('Sabado')
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Lunes a Viernes', 'Sabado', 'Domingo', 'Inhábil'), 
            servicio, turno, jornada;"
        );
        $jornadas_d = DB::connection('mysql')->select(
            "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
            COUNT(ciclo) AS total_ciclos,
            MIN(CASE 
                WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                ELSE NULL 
                END) AS primera_salida_base,
            MAX(CASE 
                WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                ELSE salida_base
                END) AS ultima_salida_base
            FROM t_jornada_completa_operacion_2
            WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
            AND dia_servicio IN ('Domingo')
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Lunes a Viernes', 'Sabado', 'Domingo', 'Inhábil'), 
            servicio, turno, jornada;"
        );
                // Mostrar el resultado , 'Sabado', 'Domingo', 'Inhábil'
        
        $consulta2 =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Lunes a Viernes"',[$semana_hoy['value']]
        );
                    //dd($consulta2);
        $consulta3 =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Sábado" ',[$semana_hoy['value']]
        );
        $consulta4 =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Domingo"',[$semana_hoy['value']]
        );
        $conductores = [];
        foreach ($consulta2 as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores[$key] = $conductor;
        }
        $conductores3 = [];
        foreach ($consulta3 as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores3[$key] = $conductor;
        }
        $conductores4 = [];
        foreach ($consulta4 as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores4[$key] = $conductor;
        }
        $jornadas_combinadas = [];
        foreach ($jornadas_m as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores[$key])) {
                $jornada->conductor = $conductores[$key]->name. " - ". $conductores[$key]->id;
            } else {
                $jornada->conductor = 'Sin conductor';
            }
            $jornadas_combinadas[] = $jornada;
        }
        $jornadas_combinadas3 = [];
        foreach ($jornadas_s as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores3[$key])) {
                $jornada->conductor = $conductores3[$key]->name. " - ". $conductores3[$key]->id;
            } else {
                $jornada->conductor = 'Sin conductor';
            }
            $jornadas_combinadas3[] = $jornada;
        }
        $jornadas_combinadas4 = [];
        foreach ($jornadas_d as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores4[$key])) {
                $jornada->conductor = $conductores4[$key]->name. " - ". $conductores4[$key]->id;
            } else {
                $jornada->conductor = 'Sin conductor';
            }
            $jornadas_combinadas4[] = $jornada;
        }
                   // dd($jornadas_m);
        $conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores as $key => $conductor) {
            foreach ($consulta2 as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores[$key]);
                }
            }
        }

        $conductores = array_values($conductores);

        $conductores_s = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_s as $key => $conductor) {
            foreach ($consulta3 as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_s[$key]);
                }
            }
        }

        $conductores_s = array_values($conductores_s);

        $conductores_d = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_d as $key => $conductor) {
            foreach ($consulta4 as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_d[$key]);
                }
            }
        }

        $conductores_d = array_values($conductores_d);


        $semana_seleccionada=$semana_hoy['value'];
        
        
        $conductores_totales = count($conductores);
       // dd($jornadas_m);
        return view('Transmasivo.Operaciones.enrolar_horarios_conductores_2',
            compact('where','dia_inicio','dia_fin','jornadas_m','jornadas_s','jornadas_d','conductores','conductores_s','conductores_d','conductores_totales','semana_seleccionada'));
    }

    public function post_enrolar_horarios_conductores_2(Request $request)
    {
        if($request->has('Buscar'))
        {
            $where="";
            $currentYear = \Carbon\Carbon::now()->year;
            $today = \Carbon\Carbon::today()->format('Y-m-d');
            $semanas = [];
            $j = 1;
            $dia_inicio ;
            $dia_fin ;
            $selectedSemana = '';
            $semana_hoy = null; // Variable para almacenar la semana actual
            
            for ($week = 1; $week <= 52; $week++) {
                $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                $semanaValue = "$startOfWeek 00:00:00 al $endOfWeek 23:59:59";
                $semanas[] = [
                    'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                    'value' => $semanaValue
                ];
                
                if ($today >= $startOfWeek && $today <= $endOfWeek) {
                    $selectedSemana = $semanaValue;
                    $dia_inicio = $startOfWeek;
                    $dia_fin = $endOfWeek;
                    $semana_hoy = [
                        'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                        'value' => $semanaValue
                    ];
                }
                $j++;
            }
            
            $jornadas_m = DB::connection('mysql')->select(
                "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
                COUNT(ciclo) AS total_ciclos,
                MIN(CASE 
                    WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                    ELSE NULL 
                    END) AS primera_salida_base,
                MAX(CASE 
                    WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                    ELSE salida_base
                    END) AS ultima_salida_base
                FROM t_jornada_completa_operacion_2
                WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
                AND dia_servicio IN ('Lunes a Viernes')
                
                AND turno IN ('Vespertino','Matutino')
                GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
                ORDER BY FIELD(dia_servicio, 'Lunes a Viernes'), 
                servicio, turno, jornada;"
            );
            $jornadas_s = DB::connection('mysql')->select(
                "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
                COUNT(ciclo) AS total_ciclos,
                MIN(CASE 
                    WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                    ELSE NULL 
                    END) AS primera_salida_base,
                MAX(CASE 
                    WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                    ELSE salida_base
                    END) AS ultima_salida_base
                FROM t_jornada_completa_operacion_2
                WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
                AND dia_servicio IN ('Sabado')
                AND turno IN ('Vespertino','Matutino')
                GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
                ORDER BY FIELD(dia_servicio, 'Lunes a Viernes', 'Sabado', 'Domingo', 'Inhábil'), 
                servicio, turno, jornada;"
            );
            $jornadas_d = DB::connection('mysql')->select(
                "SELECT servicio,id_jornada_pk, dia_servicio, turno, jornada,
                COUNT(ciclo) AS total_ciclos,
                MIN(CASE 
                    WHEN TIME(salida_base) >= '03:00:00' THEN salida_base
                    ELSE NULL 
                    END) AS primera_salida_base,
                MAX(CASE 
                    WHEN TIME(salida_base) < '03:00:00' THEN ADDTIME(salida_base, '24:00:00') 
                    ELSE salida_base
                    END) AS ultima_salida_base
                FROM t_jornada_completa_operacion_2
                WHERE servicio IN ('TR1','TR1-R','TR3','TR4')
                AND dia_servicio IN ('Domingo')
                AND turno IN ('Vespertino','Matutino')
                GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
                ORDER BY FIELD(dia_servicio, 'Lunes a Viernes', 'Sabado', 'Domingo', 'Inhábil'), 
                servicio, turno, jornada;"
            );
                    // Mostrar el resultado , 'Sabado', 'Domingo', 'Inhábil'
            
            $consulta2 =  DB::connection('mysql')->select(
                'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Lunes a Viernes"',[$request->input('semana')]
            );
            $consulta3 =  DB::connection('mysql')->select(
                'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Sábado" ',[$request->input('semana')]
            );
            $consulta4 =  DB::connection('mysql')->select(
                'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? and dia_servicio="Domingo"',[$request->input('semana')]
            );
            $conductores = [];
            foreach ($consulta2 as $conductor) {
                $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
                $conductores[$key] = $conductor;
            }
            $jornadas_combinadas = [];
            foreach ($jornadas_m as $jornada) {
                $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
                if (isset($conductores[$key])) {
                    $jornada->conductor = $conductores[$key]->name. " - ". $conductores[$key]->id;
                } else {
                    $jornada->conductor = 'Sin conductor';
                }
                $jornadas_combinadas[] = $jornada;
            }
            foreach ($jornadas_s as $jornada) {
                $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
                if (isset($conductores[$key])) {
                    $jornada->conductor = $conductores[$key]->name. " - ". $conductores[$key]->id;
                } else {
                    $jornada->conductor = 'Sin conductor';
                }
                $jornadas_combinadas[] = $jornada;
            }
            foreach ($jornadas_d as $jornada) {
                $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
                if (isset($conductores[$key])) {
                    $jornada->conductor = $conductores[$key]->name. " - ". $conductores[$key]->id;
                } else {
                    $jornada->conductor = 'Sin conductor';
                }
                $jornadas_combinadas[] = $jornada;
            }
            
            $conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
            foreach ($conductores as $key => $conductor) {
                foreach ($consulta2 as $c2) {
                    if ($conductor->id == $c2->id_conductor) {
                        unset($conductores[$key]);
                    }
                }
            }
            
            $conductores = array_values($conductores);


            $conductores_s = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
            foreach ($conductores_s as $key => $conductor) {
                foreach ($consulta3 as $c2) {
                    if ($conductor->id == $c2->id_conductor) {
                        unset($conductores_s[$key]);
                    }
                }
            }

            $conductores_s = array_values($conductores_s);

            $conductores_d = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
            foreach ($conductores_d as $key => $conductor) {
                foreach ($consulta4 as $c2) {
                    if ($conductor->id == $c2->id_conductor) {
                        unset($conductores_d[$key]);
                    }
                }
            }

            $conductores_d = array_values($conductores_d);
            $semana = $request->input('semana');

            // Dividir la cadena en dos partes usando " al " como delimitador
            list($dia_inicio, $dia_fin) = explode(' al ', $semana);

            // Extraer solo la parte de la fecha (años, mes y día) de cada variable
            $dia_inicio = substr($dia_inicio, 0, 10); // Resultado: 2024-09-23
            $dia_fin = substr($dia_fin, 0, 10);      // Resultado: 2024-09-29


            $semana_seleccionada=$request->input('semana');
            $conductores_totales = count($conductores);
            
            return view('Transmasivo.Operaciones.enrolar_horarios_conductores_2',
                compact('where','dia_inicio','dia_fin','jornadas_m','jornadas_s','jornadas_d','conductores','conductores_s','conductores_d','conductores_totales','semana_seleccionada'));
            
        }
        if($request->has('enrolar'))
        {

            $hidden_servicio = '';
            $hidden_dia_servicio = '';
            $hidden_turno = '';
            $hidden_jornada = '';
            $semana_hidden = '';
            $dia_inicio = '';
            $dia_fin = '';
            $hidden_id_jornada_pk = '';

            if($request->has('hidden_servicio'))
            {
                $hidden_servicio = $request->input('hidden_servicio');
                $hidden_dia_servicio = $request->input('hidden_dia_servicio');
                $hidden_turno = $request->input('hidden_turno');
                $hidden_jornada = $request->input('hidden_jornada');
                $semana_hidden = $request->input('semana_hidden');
                $dia_inicio = $request->input('dia_inicio_lv');
                $dia_fin = $request->input('dia_fin_lv');
                
                $hidden_id_jornada_pk = $request->input('hidden_id_jornada_pk');
            }
            if($request->has('hidden_servicio_s'))
            {
                $hidden_servicio = $request->input('hidden_servicio_s');
                $hidden_dia_servicio = $request->input('hidden_dia_servicio_s');
                $hidden_turno = $request->input('hidden_turno_s');
                $hidden_jornada = $request->input('hidden_jornada_s');
                $semana_hidden = $request->input('semana_hidden_s');
                $dia_inicio = $request->input('dia_inicio_s');
                $dia_fin = $request->input('dia_fin_s');
                $hidden_id_jornada_pk = $request->input('hidden_id_jornada_pk_s');

            }
            if($request->has('hidden_servicio_d'))
            {
                $hidden_servicio = $request->input('hidden_servicio_d');
                $hidden_dia_servicio = $request->input('hidden_dia_servicio_d');
                $hidden_turno = $request->input('hidden_turno_d');
                $hidden_jornada = $request->input('hidden_jornada_d');
                $semana_hidden = $request->input('semana_hidden_d');
                $dia_inicio = $request->input('dia_inicio_d');
                $dia_fin = $request->input('dia_fin_d');
                $hidden_id_jornada_pk = $request->input('hidden_id_jornada_pk_d');
                
            }
            

            $conductores = $request->input('conductores');
            $id_operador_registra = auth()->id();
            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();
            $fecha_registro = date('Y-m-d H:i:s', $hora_actual);
            $conductores = DB::connection('mysql')->insert(
                'insert into t_jornada_conductores (id_conductor,id_jornada_fk,servicio,dia_servicio,turno,jornada,semana,id_operador,fecha_registro,dia_inicio,dia_fin ) values(?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $conductores ,
                    $hidden_id_jornada_pk ,
                    $hidden_servicio ,
                    $hidden_dia_servicio ,
                    $hidden_turno ,
                    $hidden_jornada ,
                    $semana_hidden ,
                    $id_operador_registra ,
                    $fecha_registro ,
                    $dia_inicio ,
                    $dia_fin ,
                ]
            );
            $mensaje="Se registro con exito!!";
            $color="success";
            
            $semana_seleccionada=$request->input('semana');
            return redirect()->route('enrolar_horarios_conductores_2',compact('semana_seleccionada'))->with('mensaje', $mensaje)->with('color', $color)->with('semana_seleccionada', $semana_seleccionada);
        }
        
    }


    public function buscar_horario_completo(Request $request)
    {   
        $servicio = $request->input('servicio');
        $dia_servicio = $request->input('dia_servicio');
        $turno = $request->input('turno');
        $jornada = $request->input('jornada');
        
        return DB::connection('mysql')->select(
            'SELECT * FROM t_jornada_completa_operacion_2 WHERE servicio = ? AND dia_servicio = ? AND turno = ? AND jornada = ?', 
            [
                $servicio,
                $dia_servicio,
                $turno,
                $jornada
            ]
        );
    }
    
    public function post_enrolar_horarios_conductores(Request $request)
    {
        if($request->has('enrolar'))
        {
            

            $id_rol_operador = $request->input('hidden_id_rol_operador');
            $fecha_inicio = $request->input('semana_hidden');
            $fecha_inicio_cortada = substr($fecha_inicio, 1, 10);
            $fecha_fin = $request->input('semana_hidden');
            $fecha_fin_cortada = substr($fecha_fin, 27, 10);
            $id_conductor = $request->input('conductores');
            $id_operador_registra = auth()->id();
            date_default_timezone_set('America/Mexico_City');
            $hora_actual = time();
            $fecha_registro = date('Y-m-d H:i:s', $hora_actual);

            $result = DB::connection('mysql')->select('insert into t_rol_semanal_conductor (id_rol_operadores,fecha_inicio,fecha_fin,id_conductor,id_operador_registra,fecha_registro) values(?,?,?,?,?,?)'
                , [
                    $id_rol_operador,
                    $fecha_inicio_cortada,
                    $fecha_fin_cortada,
                    $id_conductor,
                    $id_operador_registra,
                    $fecha_registro,
                ]);



            $where="";
            $currentYear = \Carbon\Carbon::now()->year;
            $today = \Carbon\Carbon::today()->format('Y-m-d');
            $semanas = [];
            $j = 1;
            $selectedSemana = '';
                    $semana_hoy = null; // Variable para almacenar la semana actual
                    
                    for ($week = 1; $week <= 52; $week++) {
                        $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                        $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                        $semanaValue = "'$startOfWeek 00:00:00' AND '$endOfWeek 23:59:59'";
                        $semanas[] = [
                            'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                            'value' => $semanaValue
                        ];
                        
                        // Verificar si hoy está dentro de esta semana
                        if ($today >= $startOfWeek && $today <= $endOfWeek) {
                            $selectedSemana = $semanaValue;
                            $semana_hoy = [
                                'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                                'value' => $semanaValue
                            ];
                        }
                        
                        $j++;
                    }
                    
                    $consulta=DB::connection('mysql')->select("SELECT t_rol_operadores.id_rol_operador,t_rol_operadores.servicio,t_rol_operadores.jornada,t_rol_operadores.turno,t_rol_operadores.ciclos,
                        t_rol_operadores.horas,t_rol_operadores.posicion, t_rol_operadores.lunes,t_rol_operadores.martes, t_rol_operadores.miercoles,t_rol_operadores.jueves,t_rol_operadores.viernes,
                        t_rol_operadores.sabado,t_rol_operadores.domingo,
                        CASE
                        WHEN servicio = 'esto es una pruebas' THEN null
                        ELSE NULL
                        END AS id_conductor,
                        CASE
                        WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                        WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                        WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                        WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                        ELSE NULL
                        END AS total_tiempo,
                        CASE 
                        WHEN lunes = '02:02:02' THEN lunes
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS lunes_total,
                        CASE 
                        WHEN martes = '02:02:02' THEN martes
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS martes_total,
                        CASE 
                        WHEN miercoles = '02:02:02' THEN miercoles
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS miercoles_total,
                        CASE 
                        WHEN jueves = '02:02:02' THEN jueves
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS jueves_total,
                        CASE 
                        WHEN viernes = '02:02:02' THEN viernes
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS viernes_total,
                        CASE 
                        WHEN sabado = '02:02:02' THEN sabado
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS sabado_total,
                        CASE 
                        WHEN domingo = '02:02:02' THEN domingo
                        ELSE SEC_TO_TIME(
                            CASE
                            WHEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) > TIME_TO_SEC('23:59:59')
                            THEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END) - TIME_TO_SEC('24:00:00')
                            ELSE TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                                WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                                WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                                WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                                ELSE '00:00:00'
                                END)
                            END
                            ) 
                        END AS domingo_total
                        FROM  t_rol_operadores 
                        ;");   
$consulta2 = DB::connection('mysql')->select('select * from t_rol_semanal_conductor 
    inner join users on users.id=t_rol_semanal_conductor.id_conductor
    where fecha_inicio  between '. $fecha_inicio.'');
foreach ($consulta as &$item) {
    foreach ($consulta2 as $c2) {
        if ($item->id_rol_operador == $c2->id_rol_operadores) {
            $item->id_conductor = $c2->id . ' - ' . $c2->name;
            break;
        }
    }
}

$conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');

foreach ($conductores as $key => $conductor) {
    foreach ($consulta2 as $c2) {
        if ($conductor->id == $c2->id_conductor) {
            unset($conductores[$key]);
        }
    }
}

$conductores = array_values($conductores);
$semana_seleccionada=$fecha_inicio;
$conductores_enrolados = count($consulta2);
$conductores_totales = count($conductores);
$mensaje="Conductor enrolado";
$color="success";

return redirect()->route('enrolar_horarios_conductores')->with('where', $where)->with('consulta', $consulta)->with('conductores_enrolados', $conductores_enrolados)
->with('conductores_totales', $conductores_totales)->with('semana_seleccionada', $semana_seleccionada)->with('mensaje', $mensaje)->with('color', $color);




}
if($request->has('Buscar')){
    
    $where="";
    $semana_seleccionada=$request->input('semana');
    $currentYear = \Carbon\Carbon::now()->year;
    $today = \Carbon\Carbon::today()->format('Y-m-d');
    $semanas = [];
    $j = 1;
    $selectedSemana = '';
                $semana_hoy = null; // Variable para almacenar la semana actual

                for ($week = 1; $week <= 52; $week++) {
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                    $semanaValue = "'$startOfWeek 00:00:00' AND '$endOfWeek 23:59:59'";
                    $semanas[] = [
                        'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                        'value' => $semanaValue
                    ];
                    
                    // Verificar si hoy está dentro de esta semana
                    if ($today >= $startOfWeek && $today <= $endOfWeek) {
                        $selectedSemana = $semanaValue;
                        $semana_hoy = [
                            'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                            'value' => $semanaValue
                        ];
                    }
                    
                    $j++;
                }

                $consulta=DB::connection('mysql')->select("SELECT t_rol_operadores.id_rol_operador,t_rol_operadores.servicio,t_rol_operadores.jornada,t_rol_operadores.turno,t_rol_operadores.ciclos,
                    t_rol_operadores.horas,t_rol_operadores.posicion, t_rol_operadores.lunes,t_rol_operadores.martes, t_rol_operadores.miercoles,t_rol_operadores.jueves,t_rol_operadores.viernes,
                    t_rol_operadores.sabado,t_rol_operadores.domingo,

                    CASE
                    WHEN servicio = 'esto es una pruebas' THEN null
                    ELSE NULL
                    END AS id_conductor,
                    CASE
                    WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                    WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                    ELSE NULL
                    END AS total_tiempo,
                    CASE 
                    WHEN lunes = '02:02:02' THEN lunes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS lunes_total,
                    CASE 
                    WHEN martes = '02:02:02' THEN martes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS martes_total,
                    CASE 
                    WHEN miercoles = '02:02:02' THEN miercoles
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS miercoles_total,
                    CASE 
                    WHEN jueves = '02:02:02' THEN jueves
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS jueves_total,
                    CASE 
                    WHEN viernes = '02:02:02' THEN viernes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS viernes_total,
                    CASE 
                    WHEN sabado = '02:02:02' THEN sabado
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS sabado_total,
                    CASE 
                    WHEN domingo = '02:02:02' THEN domingo
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS domingo_total
                    FROM  t_rol_operadores   ;");   

$consulta2 = DB::connection('mysql')->select('select * from t_rol_semanal_conductor 
    inner join users on users.id=t_rol_semanal_conductor.id_conductor
    where fecha_inicio  between '.$semana_seleccionada.'');

                //dd($consulta);
foreach ($consulta as &$item) {
    foreach ($consulta2 as $c2) {
        if ($item->id_rol_operador == $c2->id_rol_operadores) {
            $item->id_conductor = $c2->id . ' - ' . $c2->name;
            break;
        }
    }
}

$conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');

foreach ($conductores as $key => $conductor) {
    foreach ($consulta2 as $c2) {
        if ($conductor->id == $c2->id_conductor) {
            unset($conductores[$key]);
        }
    }
}
$conductores = array_values($conductores);

$conductores_enrolados = count($consulta2);
$conductores_totales = count($conductores);

return view('Transmasivo.Operaciones.enrolar_horarios_conductores',compact('where','consulta','conductores_enrolados','conductores_totales','conductores','semana_seleccionada'));
}
}

public function bitacora_de_operaciones_2(Request $request)
{
    $where="";
    $currentYear = \Carbon\Carbon::now()->year;
    $today = \Carbon\Carbon::today()->format('Y-m-d');
    $semanas = [];
    $j = 1;
    $selectedSemana = '';
                $semana_hoy = null; // Variable para almacenar la semana actual

                for ($week = 1; $week <= 52; $week++) {
                    $startOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->startOfWeek()->format('Y-m-d');
                    $endOfWeek = \Carbon\Carbon::now()->setISODate($currentYear, $week)->endOfWeek()->format('Y-m-d');
                    $semanaValue = "'$startOfWeek 00:00:00' AND '$endOfWeek 23:59:59'";
                    $semanas[] = [
                        'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                        'value' => $semanaValue
                    ];
                    
                    // Verificar si hoy está dentro de esta semana
                    if ($today >= $startOfWeek && $today <= $endOfWeek) {
                        $selectedSemana = $semanaValue;
                        $semana_hoy = [
                            'label' => "Semana $j - " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($startOfWeek)->translatedFormat('F') . " al " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('d') . " de " . \Carbon\Carbon::parse($endOfWeek)->translatedFormat('F') . " $currentYear",
                            'value' => $semanaValue
                        ];
                    }
                    
                    $j++;
                }

                $consulta=DB::connection('mysql')->select("SELECT t_rol_operadores.id_rol_operador,t_rol_operadores.servicio,t_rol_operadores.jornada,t_rol_operadores.turno,t_rol_operadores.ciclos,
                    t_rol_operadores.horas,t_rol_operadores.posicion, t_rol_operadores.lunes,t_rol_operadores.martes, t_rol_operadores.miercoles,t_rol_operadores.jueves,t_rol_operadores.viernes,
                    t_rol_operadores.sabado,t_rol_operadores.domingo,
                    CASE
                    WHEN servicio = 'esto es una pruebas' THEN null
                    ELSE NULL
                    END AS id_conductor,
                    CASE
                    WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                    WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                    WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                    ELSE NULL
                    END AS total_tiempo,
                    CASE 
                    WHEN lunes = '02:02:02' THEN lunes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(lunes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS lunes_total,
                    CASE 
                    WHEN martes = '02:02:02' THEN martes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(martes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS martes_total,
                    CASE 
                    WHEN miercoles = '02:02:02' THEN miercoles
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(miercoles) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS miercoles_total,
                    CASE 
                    WHEN jueves = '02:02:02' THEN jueves
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(jueves) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS jueves_total,
                    CASE 
                    WHEN viernes = '02:02:02' THEN viernes
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(viernes) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS viernes_total,
                    CASE 
                    WHEN sabado = '02:02:02' THEN sabado
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(sabado) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS sabado_total,
                    CASE 
                    WHEN domingo = '02:02:02' THEN domingo
                    ELSE SEC_TO_TIME(
                        CASE
                        WHEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) > TIME_TO_SEC('23:59:59')
                        THEN TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END) - TIME_TO_SEC('24:00:00')
                        ELSE TIME_TO_SEC(domingo) + TIME_TO_SEC(CASE
                            WHEN servicio = 'TR1' THEN SEC_TO_TIME(TIME_TO_SEC('00:39:00') * (ciclos*2))
                            WHEN servicio = 'TR3' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR3-R' THEN SEC_TO_TIME(TIME_TO_SEC('00:30:00') * (ciclos*2))
                            WHEN servicio = 'TR4' THEN SEC_TO_TIME(TIME_TO_SEC('00:20:00') * (ciclos*2))
                            ELSE '00:00:00'
                            END)
                        END
                        ) 
                    END AS domingo_total
                    FROM  t_rol_operadores 
                    ;");   
$consulta2 = DB::connection('mysql')->select('select * from t_rol_semanal_conductor 
    inner join users on users.id=t_rol_semanal_conductor.id_conductor
    where fecha_inicio  between '.$semana_hoy['value'].'');
foreach ($consulta as &$item) {
    foreach ($consulta2 as $c2) {
        if ($item->id_rol_operador == $c2->id_rol_operadores) {
            $item->id_conductor = $c2->id . ' - ' . $c2->name;
            break;
        }
    }
}

$conductores = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');

foreach ($conductores as $key => $conductor) {
    foreach ($consulta2 as $c2) {
        if ($conductor->id == $c2->id_conductor) {
            unset($conductores[$key]);
        }
    }
}

$conductores = array_values($conductores);
$semana_seleccionada=$semana_hoy['value'];
$conductores_enrolados = count($consulta2);
$conductores_totales = count($conductores);
return view('Transmasivo.Operaciones.bitacora_de_operaciones_2',compact('where','consulta','conductores','conductores_enrolados','conductores_totales','semana_seleccionada'));
}
public function Bitacora_de_operaciones_pdf(Request $request)
{
    
    $this->generarPDF();
}
public function Registro_bitacora_terminal(Request $request)
{
    if($request->has("pdf"))
    {
        return $this->generarPDF();
    }
    if($request->has("Excel"))
    {
        return $this->generarExcel();
    }else{
        $terminal=$request->input('terminal');
        $hora_llegada=$request->input('hora_llegada');
        $serv=$request->input('serv');
        $jorn=$request->input('jorn');
        $eco=$request->input('eco');
        $credencial=$request->input('credencial');
        $km=$request->input('km');
        $hora_salida=$request->input('hora_salida');
        $dia=$request->input('dia');
        $id_jornada_sem=$request->input('id_jornada_sem');
        $llegada_salida=$request->input('llegada_salida');
        
        $comentarios=$request->input('comentarios');
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 3600;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        $bitacora = new t_bitacora_terminales();
        $bitacora->terminal = $terminal;
        $bitacora->hora_llegada = $hora_llegada;
        $bitacora->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
        $bitacora->eco = $eco;
        $bitacora->dia = $dia;
        $bitacora->credencial = $credencial;
        $bitacora->hora_salida = $hora_salida;
        $bitacora->id_jornada_sem = $id_jornada_sem;
        $bitacora->comentario = $comentarios;
        $bitacora->fecha_registro = $hora_formateada; // Fecha de registro actual
        $bitacora->id_usuario = Auth::id();
        $bitacora->save();        
        $mensaje="Se registro con exito!";
        $color="success";
        return redirect()->route('Bitacora_de_operaciones')->with('mensaje', $mensaje)->with('color', $color);
    }
        
    }

    public function buscar_rol_operador(Request $request)
    {
        $credencial = $request->input('credencial');
        $dia = $request->input('dia');
        $diasSemana = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miércoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo'
        ];
        $diaActualIngles = date('l', strtotime($dia)); 
        $diaActualEspanol = $diasSemana[$diaActualIngles]; 
        $id_rol_operadores = null; 
        if (in_array($diaActualEspanol, ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'])) {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  
                AND dia_servicio = "Lunes a Viernes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'sábado') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  
                AND dia_servicio = "Sábado"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'domingo') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  
                AND dia_servicio = "Domingo"', [$credencial, $dia]
            );
        }

        if (!$id_rol_operadores) {
            return ['error' => 'No se encontró el rol para el conductor en ese día'];
        }

        $jornada = DB::connection('mysql')->select(
            'SELECT * FROM t_jornada_completa_operacion_2 
            WHERE servicio = ? 
            AND jornada = ? 
            AND dia_servicio = ? 
            AND turno = ?', 
            [$id_rol_operadores[0]->servicio, $id_rol_operadores[0]->jornada, $id_rol_operadores[0]->dia_servicio, $id_rol_operadores[0]->turno]
        );
        $t_bitacora_terminales = DB::connection('mysql')->select(
            'SELECT * FROM t_bitacora_terminales 
            WHERE dia = ? 
            AND credencial = ? ', 
            [$dia, $credencial]
        );
        $conteo_jornada_total = count($jornada) * 2;
        $id_jornada = $jornada[0]->id_jornada_pk;
        $conteo_jornada_hecha = count($t_bitacora_terminales);
        $nombre = $id_rol_operadores[0]->name;
        $servicio=$id_rol_operadores[0]->servicio;
        return [
            'conteo_jornada_total' => $conteo_jornada_total,
            'conteo_jornada_hecha' => $conteo_jornada_hecha,
            'id_jornada' => $id_jornada,
            'Nombre' => $nombre,
            'servicio' => $servicio,
            'dia_actual_espanol' => $diaActualEspanol, 
        ];
    }



    public function generarExcel()
    {
        
        $consulta = DB::connection('mysql')->select('
            SELECT t_bitacora_terminales.Servicio,t_jornada_conductores.Jornada as jorna,t_bitacora_terminales.Servicio,
            t_bitacora_terminales.hora_llegada,t_bitacora_terminales.hora_salida,
           t_bitacora_terminales.dia,t_bitacora_terminales.id_usuario ,t_bitacora_terminales.credencial,
             t_jornada_conductores.jornada as jorna ,users.name,(SELECT COUNT(*)  FROM t_bitacora_terminales t2
                    WHERE t2.credencial = t_bitacora_terminales.credencial and dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
                    AND t2.id_bitacora_terminales <= t_bitacora_terminales.id_bitacora_terminales ) AS posicion
            FROM t_bitacora_terminales INNER JOIN c_terminal   ON c_terminal.id_terminal = t_bitacora_terminales.terminal
            INNER JOIN users   ON users.id = t_bitacora_terminales.credencial
            INNER JOIN t_jornada_conductores   ON t_jornada_conductores.id_jornada_fk = t_bitacora_terminales.id_jornada_sem
            WHERE t_bitacora_terminales.dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
               and  "' . now()->format('Y-m-d') . '"  BETWEEN  t_jornada_conductores.dia_inicio and t_jornada_conductores.dia_fin
            ORDER BY credencial, posicion,  CASE   WHEN TIME(hora_salida) >= "03:00:00" THEN 0    ELSE 1  END,   hora_salida ASC
        ');
        $tr1_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr1_r_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1-R" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr3_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR3" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        $tr4_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR4" AND dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00"  AND "' . now()->format('Y-m-d') . ' 23:59:59"
        ');
        
        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" AND "' . now()->format('Y-m-d') . ' 23:59:00" GROUP BY credencial, Servicio');
        $credencial = DB::connection('mysql')->select('SELECT * FROM users WHERE tipo_usuario = "Conductor"');
        $terminal = DB::connection('mysql')->select('SELECT * FROM c_terminal');
        $consulta = json_decode(json_encode($consulta), true);
        $credenciales_registradas = json_decode(json_encode($credenciales_registradas), true);
        $diasSemana = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo'
        ];
        $diaActualIngles = date('l'); // Día actual en inglés
        $diaActualEspanol = $diasSemana[$diaActualIngles]; // Día actual traducido al español
        $tr1_ciclos;
        $tr1_r_ciclos;
        $tr3_ciclos;
        $tr4_ciclos;
        $total_ciclos;

       
        //dd($consulta);
        if( $diaActualEspanol=='lunes' ||$diaActualEspanol=='martes' ||$diaActualEspanol=='miercoles' ||$diaActualEspanol=='jueves' ||$diaActualEspanol=='viernes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
           
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes a Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='sábado'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Sábado" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='domingo'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');;
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Domingo" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }


        $total_ciclos = $tr1_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr4_ciclos[0]->conteo ; 
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador
        //dd($consulta);
        foreach ($consulta as &$registro) {
            $id_rol_operadores;
                    if( $diaActualEspanol=='lunes' ||$diaActualEspanol=='martes' ||$diaActualEspanol=='miercoles' ||$diaActualEspanol=='jueves' ||$diaActualEspanol=='viernes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes a Viernes"');
                            
                    }
                    if( $diaActualEspanol=='sábado'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Sábado"');
                    }
                    if( $diaActualEspanol=='domingo'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin and dia_servicio="Domingo"');
                    }
                    $jornada  = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_completa_operacion_2 
                        where servicio="'.$id_rol_operadores[0]->servicio.'" and jornada="'.$id_rol_operadores[0]->jornada.'"  
                        and dia_servicio="'.$id_rol_operadores[0]->dia_servicio.'" and turno="'.$id_rol_operadores[0]->turno.'" ');
                    $hora_jornada_lista;
                    $cont=0;
                    foreach($jornada as $jor){
                        $hora_jornada_lista[$cont] = $jor->salida_base;
                        $cont++;
                        $hora_jornada_lista[$cont] = $jor->salida_mitad_recorrido;
                        $cont++;
                    }
                    
                    $posicion = $registro['posicion'] - 1;
                    
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $hora_salida_jornada = 'Fuera de jornada';
                    } else {
                        $hora_salida_jornada = $hora_jornada_lista[$posicion];
                    }
                    $hora_salida_bitacora = $registro['hora_salida'];
                    $registro['hora_salida_rol'] = $hora_salida_jornada;
                    $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                    $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                    if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                        $timestamp_jornada += 86400; // 86400 seconds = 1 day
                    }
                    $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                    $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                    if ($diferencia_segundos < 0) {
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'Sobretiempo';
                    } else if ($diferencia_segundos > 0){
                        $hora_diferencia = '-' . $hora_diferencia;
                        $registro['estatus'] = 'Retardo';
                    }else if($diferencia_segundos == 0)
                    {
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'En tiempo';
                    }
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $registro['hora_diferencia'] = 'Fuera de jornada';
                        $registro['estatus'] = 'Fuera de jornada';
                    } else {
                        $registro['hora_diferencia'] = $hora_diferencia;
                    }
        }
        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        //dd($consulta);
        return Excel::download(new BitacoraConductores($consulta), 'Bitacora_de_terminales'.now().'.xlsx');
    }

    public function generarPDF()
    {
        
        $consulta = DB::connection('mysql')->select('
            SELECT *,(SELECT COUNT(*)  FROM t_bitacora_terminales t2
                    WHERE t2.credencial = t_bitacora_terminales.credencial and dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
                    AND t2.id_bitacora_terminales <= t_bitacora_terminales.id_bitacora_terminales ) AS posicion
            FROM t_bitacora_terminales INNER JOIN c_terminal   ON c_terminal.id_terminal = t_bitacora_terminales.terminal
            INNER JOIN users   ON users.id = t_bitacora_terminales.credencial
            WHERE dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" 
                        AND "' . now()->format('Y-m-d') . ' 23:59:59"
            ORDER BY credencial, posicion,  CASE   WHEN TIME(hora_salida) >= "03:00:00" THEN 0    ELSE 1  END,   hora_salida ASC
        ');
       // dd($consulta);
        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" AND "' . now()->format('Y-m-d') . ' 23:59:00" GROUP BY credencial, Servicio');
        $credencial = DB::connection('mysql')->select('SELECT * FROM users WHERE tipo_usuario = "Conductor"');
        $terminal = DB::connection('mysql')->select('SELECT * FROM c_terminal');
        $consulta = json_decode(json_encode($consulta), true);
        $credenciales_registradas = json_decode(json_encode($credenciales_registradas), true);
        $diasSemana = [
            'Monday' => 'lunes',
            'Tuesday' => 'martes',
            'Wednesday' => 'miercoles',
            'Thursday' => 'jueves',
            'Friday' => 'viernes',
            'Saturday' => 'sábado',
            'Sunday' => 'domingo'
        ];
        $diaActualIngles = date('l'); // Día actual en inglés
        $diaActualEspanol = $diasSemana[$diaActualIngles]; // Día actual traducido al español
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador
        foreach ($consulta as &$registro) {
            $id_rol_operadores;
                    if( $diaActualEspanol=='lunes' ||$diaActualEspanol=='martes' ||$diaActualEspanol=='miercoles' ||$diaActualEspanol=='jueves' ||$diaActualEspanol=='viernes' )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes a Viernes"');
                    }
                    if( $diaActualEspanol=='sábado'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Sábado"');
                    }
                    if( $diaActualEspanol=='domingo'  )
                    {
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin and dia_servicio="Domingo"');
                    }
                    $jornada  = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_completa_operacion_2 
                        where servicio="'.$id_rol_operadores[0]->servicio.'" and jornada="'.$id_rol_operadores[0]->jornada.'"  
                        and dia_servicio="'.$id_rol_operadores[0]->dia_servicio.'" and turno="'.$id_rol_operadores[0]->turno.'" ');
                    $hora_jornada_lista;
                    $cont=0;
                    foreach($jornada as $jor){
                        $hora_jornada_lista[$cont] = $jor->salida_base;
                        $cont++;
                        $hora_jornada_lista[$cont] = $jor->salida_mitad_recorrido;
                        $cont++;
                    }
                    
                    $posicion = $registro['posicion'] - 1;
                    
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $hora_salida_jornada = 'Fuera de jornada';
                    } else {
                        $hora_salida_jornada = $hora_jornada_lista[$posicion];
                    }
                    
                    $hora_salida_bitacora = $registro['hora_salida'];
                    $registro['hora_salida_rol'] = $hora_salida_jornada;
                    
                    // Convertir las horas a timestamps
                    $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                    $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor

                    // Adjust for midnight cases
                    if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                        // Add one day to the timestamp_jornada if it's before 03:00 and the bitacora time is later in the day
                        $timestamp_jornada += 86400; // 86400 seconds = 1 day
                    }

                    // Calculate the difference
                    $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                    
                    //dd($diferencia_segundos);
                    if($registro['hora_llegada']=='09:08:00'){
                // if($registro['hora_llegada']=='14:57:00'){
                        //dd($hora_salida_bitacora);
                    }
                    $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                    if ($diferencia_segundos < 0) {
                       
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'Sobretiempo';
                    } else if ($diferencia_segundos > 0){
                        //dd($diferencia_segundos);
                        
                        $hora_diferencia = '-' . $hora_diferencia;
                        $registro['estatus'] = 'Retardo';
                    }else if($diferencia_segundos == 0)
                    {
                        $hora_diferencia = '+' . $hora_diferencia;
                        $registro['estatus'] = 'En tiempo';
                    }
                    
                    // Handle 'Fuera de jornada'
                    if (count($hora_jornada_lista) < ($posicion + 1)) {
                        $registro['hora_diferencia'] = 'Fuera de jornada';
                        $registro['estatus'] = 'Fuera de jornada';
                    } else {
                        $registro['hora_diferencia'] = $hora_diferencia;
                    }

                    
        }

        

        $html = view('Transmasivo.Operaciones.reporte_bitacora_terminal', compact('terminal', 'consulta', 'credencial'))->render();
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('Bitacora de terminales.pdf');
        

    }

    public function Alta_de_reporte()
    {
        $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
            INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4)');
        $servicios = DB::connection('mysql_produc')->select('SELECT * from  cservicios WHERE idservicio IN(5,6,7,8)');
        $grupos = DB::connection('mysql_produc')->select('SELECT * from  cfallosgrales ');
        return view('Transmasivo.Operaciones.Alta_de_reporte',compact('unidades','servicios','grupos'));
    }
    public function catalogo_subgrupo(Request $request)
    {
        //return $request->all();
        return DB::connection('mysql_produc')->select('SELECT * FROM cdescfallo where falloGralfkcfallosgrales= '.$request->input("grupo_id"));
        
    }
    public function acciones(Request $request)
    {
        if(null !==$request->input('previo'))
        {
            $id=$request->input('id');
           // dd($id);
            $query = BitacoraLiberacionUnidades::query();
            $query->where('id_bitacora_liberacion_unidades', $id);
            
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
            
            WHERE  bitacora_liberacion_unidades.id_bitacora_liberacion_unidades='".$id ."' ";
            $consulta_completa.=" GROUP BY 
            
            bitacora_liberacion_unidades.n_economico,
            detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion; ";
            $query = BitacoraLiberacionUnidades::query();
            $query->where('id_bitacora_liberacion_unidades', $id);
            $consulta = $query->get();
            $consulta_fallas = DB::connection('mysql')->select($consulta_completa);
            
            //dd( $consulta_fallas);
            $res = $consulta;
            $userAttributes = $consulta->map(function ($consult) {
                return $consult->attributesToArray();
            });
            
            
                // dd($userAttributes->toArray());
            $res2=$userAttributes->toArray();
            $i=0;
            
            foreach ($res2 as &$elemento) {
                
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
                    $nuevas_columnas = ['servicio_fallas' => $consulta_fallas[$i]->Puertas__SERVICIO,];
                    $elemento = array_merge(array_slice($elemento, 0, $indice + 1),$nuevas_columnas,array_slice($elemento, $indice + 1));
                }
                if ($emergencia !== false) { $nuevas_columnas = ['emergencia_fallas' => $consulta_fallas[$i]->Puertas__EMERGENCIA,];
                $elemento = array_merge(array_slice($elemento, 0, $emergencia + 2),$nuevas_columnas,array_slice($elemento, $emergencia + 1) );
            }
            if ($neu_eje_dir_izq !== false) { $nuevas_columnas = ['neu_eje_dir_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_IZQUIERDO,];
            $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_izq + 3),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_izq + 1) );
        }
        if ($neu_eje_dir_der !== false) { $nuevas_columnas = ['neu_eje_dir_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_DIRECCIONAL_LADO_DERECHO,];
        $elemento = array_merge(array_slice($elemento, 0, $neu_eje_dir_der + 4),$nuevas_columnas,array_slice($elemento, $neu_eje_dir_der + 1) );
    }
    if ($neu_eje_int_izq !== false) { $nuevas_columnas = ['neu_eje_int_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_IZQUIERDO,];
    $elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_izq + 5),$nuevas_columnas,array_slice($elemento, $neu_eje_int_izq + 1) );
}
if ($neu_eje_int_der !== false) { $nuevas_columnas = ['neu_eje_int_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_INTERMEDIO_LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_int_der + 6),$nuevas_columnas,array_slice($elemento, $neu_eje_int_der + 1) );
}
if ($neu_eje_motr_izq !== false) { $nuevas_columnas = ['neu_eje_motr_izq_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_izq + 7),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_izq + 1) );
}
if ($neu_eje_motr_der !== false) { $nuevas_columnas = ['neu_eje_motr_der_fallas' => $consulta_fallas[$i]->NEUMATICOS_EJE_MOTRIZ__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $neu_eje_motr_der + 8),$nuevas_columnas,array_slice($elemento, $neu_eje_motr_der + 1) );
}
if ($bal_eje_dir_izq !== false) { $nuevas_columnas = ['bal_eje_dir_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_izq + 9),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_izq + 1) );
}
if ($bal_eje_dir_der !== false) { $nuevas_columnas = ['bal_eje_dir_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_DIRECCIONAL__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_dir_der + 10),$nuevas_columnas,array_slice($elemento, $bal_eje_dir_der + 1) );
}
if ($bal_eje_int_izq !== false) { $nuevas_columnas = ['bal_eje_int_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_izq + 11),$nuevas_columnas,array_slice($elemento, $bal_eje_int_izq + 1) );
}
if ($bal_eje_int_der !== false) { $nuevas_columnas = ['bal_eje_int_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_INTERMEDIO__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_int_der + 12),$nuevas_columnas,array_slice($elemento, $bal_eje_int_der + 1) );
}
if ($bal_eje_motr_izq !== false) { $nuevas_columnas = ['bal_eje_motr_izq_fallas' => $consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_izq + 13),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_izq + 1) );
}
if ($bal_eje_motr_der !== false) { $nuevas_columnas = ['bal_eje_motr_der_fallas' => $consulta_fallas[$i]->BALATAS_EJE_MOTRIZ__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bal_eje_motr_der + 14),$nuevas_columnas,array_slice($elemento, $bal_eje_motr_der + 1) );
}
if ($bols_air_eje_dir_izq !== false) { $nuevas_columnas = ['bols_air_eje_dir_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_izq + 15),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_izq + 1) );
}
if ($bols_air_eje_dir_der !== false) { $nuevas_columnas = ['bols_air_eje_dir_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_DIRECCIONAL__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_dir_der + 16),$nuevas_columnas,array_slice($elemento, $bols_air_eje_dir_der + 1) );
}
if ($bols_air_eje_int_izq !== false) { $nuevas_columnas = ['bols_air_eje_int_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_izq + 17),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_izq + 1) );
}
if ($bols_air_eje_int_der !== false) { $nuevas_columnas = ['bols_air_eje_int_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_INTERMEDIO__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_int_der + 18),$nuevas_columnas,array_slice($elemento, $bols_air_eje_int_der + 1) );
}
if ($bols_air_eje_motr_izq !== false) { $nuevas_columnas = ['bols_air_eje_motr_izq_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_izq + 19),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_izq + 1) );
}
if ($bols_air_eje_motr_der !== false) { $nuevas_columnas = ['bols_air_eje_motr_der_fallas' => $consulta_fallas[$i]->BOLSA_DE_AIRE_EJE_MOTRIZ__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $bols_air_eje_motr_der + 20),$nuevas_columnas,array_slice($elemento, $bols_air_eje_motr_der + 1) );
}
if ($asiento_conductor !== false) { $nuevas_columnas = ['asiento_conductor_fallas' => $consulta_fallas[$i]->ASIENTOS__CONDUCTOR,];
$elemento = array_merge(array_slice($elemento, 0, $asiento_conductor + 21),$nuevas_columnas,array_slice($elemento, $asiento_conductor + 1) );
}
if ($asiento_carro1 !== false) { $nuevas_columnas = ['asiento_carro1_fallas' => $consulta_fallas[$i]->ASIENTOS__CARRO_1,];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro1 + 22),$nuevas_columnas,array_slice($elemento, $asiento_carro1 + 1) );
}
if ($asiento_carro2 !== false) { $nuevas_columnas = ['asiento_carro2_fallas' => $consulta_fallas[$i]->ASIENTOS__CARRO_2,];
$elemento = array_merge(array_slice($elemento, 0, $asiento_carro2 + 23),$nuevas_columnas,array_slice($elemento, $asiento_carro2 + 1) );
}
if ($articulacion !== false) { $nuevas_columnas = ['articulacion_fallas' => $consulta_fallas[$i]->ARTICULACION__ARTICULACION,];
$elemento = array_merge(array_slice($elemento, 0, $articulacion + 24),$nuevas_columnas,array_slice($elemento, $articulacion + 1) );
}
if ($articulacion_soporte !== false) { $nuevas_columnas = ['articulacion_soporte_fallas' => $consulta_fallas[$i]->ARTICULACION__SOPORTE,];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_soporte + 25),$nuevas_columnas,array_slice($elemento, $articulacion_soporte + 1) );
}
if ($articulacion_granada !== false) { $nuevas_columnas = ['articulacion_granada_fallas' => $consulta_fallas[$i]->ARTICULACION__GRANADAS,];
$elemento = array_merge(array_slice($elemento, 0, $articulacion_granada + 26),$nuevas_columnas,array_slice($elemento, $articulacion_granada + 1) );
}
if ($calibracion_neum_granada !== false) { $nuevas_columnas = ['calibracion_neum_granada_fallas' => $consulta_fallas[$i]->CALIBRACION_DE_NEUMATICOS__GRANADAS,];
$elemento = array_merge(array_slice($elemento, 0, $calibracion_neum_granada + 27),$nuevas_columnas,array_slice($elemento, $calibracion_neum_granada + 1) );
}
if ($eje_dir_izq !== false) { $nuevas_columnas = ['eje_dir_izq_fallas' => $consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_izq + 28),$nuevas_columnas,array_slice($elemento, $eje_dir_izq + 1) );
}
if ($eje_dir_der !== false) { $nuevas_columnas = ['eje_dir_der_fallas' => $consulta_fallas[$i]->EJE_DIRECCIONAL__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_dir_der + 29),$nuevas_columnas,array_slice($elemento, $eje_dir_der + 1) );
}
if ($eje_inter_izq !== false) { $nuevas_columnas = ['eje_inter_izq_fallas' => $consulta_fallas[$i]->EJE_INTERMEDIO__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_izq + 30),$nuevas_columnas,array_slice($elemento, $eje_inter_izq + 1) );
}
if ($eje_inter_der !== false) { $nuevas_columnas = ['eje_inter_der_fallas' => $consulta_fallas[$i]->EJE_INTERMEDIO__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_inter_der + 31),$nuevas_columnas,array_slice($elemento, $eje_inter_der + 1) );
}
if ($eje_motr_izq !== false) { $nuevas_columnas = ['eje_motr_izq_fallas' => $consulta_fallas[$i]->EJE_MOTRIZ__LADO_IZQUIERDO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_izq + 32),$nuevas_columnas,array_slice($elemento, $eje_motr_izq + 1) );
}
if ($eje_motr_der !== false) { $nuevas_columnas = ['eje_motr_der_fallas' => $consulta_fallas[$i]->EJE_MOTRIZ__LADO_DERECHO,];
$elemento = array_merge(array_slice($elemento, 0, $eje_motr_der + 33),$nuevas_columnas,array_slice($elemento, $eje_motr_der + 1) );
}
if ($susp_eje1 !== false) { $nuevas_columnas = ['susp_eje1_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_1,];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje1 + 34),$nuevas_columnas,array_slice($elemento, $susp_eje1 + 1) );
}
if ($susp_eje2 !== false) { $nuevas_columnas = ['susp_eje2_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_2,];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje2 + 35),$nuevas_columnas,array_slice($elemento, $susp_eje2 + 1) );
}
if ($susp_eje3 !== false) { $nuevas_columnas = ['susp_eje3_fallas' => $consulta_fallas[$i]->SUSPENCION__EJE_3,];
$elemento = array_merge(array_slice($elemento, 0, $susp_eje3 + 36),$nuevas_columnas,array_slice($elemento, $susp_eje3 + 1) );
}
if ($tan_drenado !== false) { $nuevas_columnas = ['tan_drenado_fallas' => $consulta_fallas[$i]->TANQUE__DRENADO,];
$elemento = array_merge(array_slice($elemento, 0, $tan_drenado + 37),$nuevas_columnas,array_slice($elemento, $tan_drenado + 1) );
}
if ($tan_chicote !== false) { $nuevas_columnas = ['tan_chicote_fallas' => $consulta_fallas[$i]->TANQUE__CHICOTES,];
$elemento = array_merge(array_slice($elemento, 0, $tan_chicote + 38),$nuevas_columnas,array_slice($elemento, $tan_chicote + 1) );
}
if ($soport_motor !== false) { $nuevas_columnas = ['soport_motor_fallas' => $consulta_fallas[$i]->SOPORTES__MOTOR,];
$elemento = array_merge(array_slice($elemento, 0, $soport_motor + 39),$nuevas_columnas,array_slice($elemento, $soport_motor + 1) );
}
if ($soport_transmi !== false) { $nuevas_columnas = ['soport_transmi_fallas' => $consulta_fallas[$i]->SOPORTES__TRANSMISION,];
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
$html = view('Transmasivo.Operaciones.reporte_bitacora_terminal',compact('res'))->render();
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
return $dompdf->stream('Autorización de economicos '.now().'.pdf');
}
if(null !==$request->input('Aprobar'))
{
    
    DB::connection('mysql')->table('bitacora_liberacion_unidades')
    ->where('id_bitacora_liberacion_unidades', $request->input('id'))
    ->update(['estatus' => $request->input('Aprobar')]);
    return $this->Autorizacion_check_mantenimiento('Se aprobo con exito!!','success');
}
if(null !==$request->input('Rechazar'))
{
    DB::connection('mysql')->table('bitacora_liberacion_unidades')
    ->where('id_bitacora_liberacion_unidades', $request->input('id'))
    ->update(['estatus' => $request->input('Rechazar')]);
    return $this->Autorizacion_check_mantenimiento('Se rechazo con exito','success');
}
if(null !==$request->input('pendientes'))
{
    DB::connection('mysql')->table('bitacora_liberacion_unidades')
    ->where('id_bitacora_liberacion_unidades', $request->input('id'))
    ->update(['estatus' => $request->input('pendientes')]);
    return $this->Autorizacion_check_mantenimiento('Se aprobo con exito, con pendiente menor','info');
}
}
public function bannerModulo200($mensaje="", $color="")
{
    return view('Transmasivo.Operaciones.bannerModulo200',compact('mensaje','color'));
    
}
public function subirBannerOperaciones(Request $request)
{
    
    $file =$request->file('uploadImg');
    date_default_timezone_set('America/Mexico_City');
    $hora_actual = time();
    $hora_una_hora_atras = $hora_actual - 0;
    $hora_formateada2 = date('Y_m_d_H_i_s', $hora_una_hora_atras);
    $extension = $file->getClientOriginalExtension();
    $NombreFinal =  auth()->user()->id ."_".$hora_formateada2.".".$extension;
    $file->move(public_path().'/images/Operaciones/',$NombreFinal);

    $pantalla= $request->input('pantalla');
    $ultimo = DB::connection('mysql')->select('SELECT id
        FROM banner200 
        ORDER BY id DESC 
        LIMIT 1;');
    $masuno=$ultimo[0]->id;
    $masuno=$masuno + 1;

    DB::connection('mysql')->table('banner200')->insert([
        'imagen' => $NombreFinal,
        'pantalla' => $pantalla,
        'estatus' => 'Activo',
        'orden' => $masuno
    ]);
    
    return $this->bannerModulo200('Se subio la imagen correctamente!','success');
}
public function m200()
{
    $images = DB::connection('mysql')->select('SELECT * 
        FROM banner200 
        WHERE estatus="Activo"
        ORDER BY  orden ASC,
        CASE 
        WHEN RIGHT(imagen, 3) = "mp4" THEN 1 
        ELSE 0 
        END, 
        imagen; ');
    return view('Transmasivo.Operaciones.200',compact('images'));
}

public function modificar_banner_200($mensaje="",$color="")
{
 
    $images = DB::connection('mysql')->select('SELECT * FROM banner200 WHERE estatus IN ("Activo", "Inactivo") ORDER BY estatus ASC, orden ASC;      ');
    $cuenta = DB::connection('mysql')->select('SELECT count(*) as cuenta FROM banner200 where estatus in ("Activo") ');
        //dd($cuenta);
    return view('Transmasivo.Operaciones.modificar_banner_200',compact('images','mensaje','color','cuenta'));
}
public function cambiar_estatus_banner_200(Request $request)
{
    if($request->has('cambiar_segundos')){
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id2'))
        ->update(['pantalla' => $request->input('pantalla')]);
        
        return $this->modificar_banner_200('Se actualizo los segundos correctamente!','success');
    }else if($request->has('Desactivar')){
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id'))
        ->update(['estatus' => 'Inactivo']);
        
        return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
    }else if($request->has('Eliminar')){
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id'))
        ->update(['estatus' => 'Eliminar']);
        
        return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
    }else if($request->has('Activo')){
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id'))
        ->update(['estatus' => 'Activo']);
        
        return $this->modificar_banner_200('Se actualizo el estatus correctamente!','success');
    }
    else if($request->has('Bajar')){
        $actual=$request->input('orden_subir_bajar');
        $actual_menos= $actual ;
        $contador= DB::connection('mysql')->table('banner200')->get();
           // dd(count($contador));
        $consultar="";
        for ($i = 0;count($contador)>$i;$i++) {

            $actual_menos= $actual_menos + 1;
            $consultar= DB::connection('mysql')->table('banner200')->where('orden', $actual_menos)->get();
                //dd($consultar[0]->estatus);
            if($consultar[0]->estatus == 'Activo'){
                    //dd($i);
                break;
            }
        } 
            //dd($consultar);
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id_subir_bajar'))
        ->update(['orden' => $consultar[0]->orden]);

        DB::connection('mysql')->table('banner200')
        ->where('id', $consultar[0]->id)
        ->update(['orden' => $request->input('orden_subir_bajar')]);
        
        
        return redirect()->route('modificar_banner_200')->with('mensaje', 'Se actualizo el orden correctamente!')->with('color', 'success');
    }
    else if($request->has('Subir')){
        $actual=$request->input('orden_subir_bajar');
        $actual_menos= $actual ;
        $contador= DB::connection('mysql')->table('banner200')->get();
           // dd(count($contador));
        $consultar="";
        for ($i = 0;count($contador)>$i;$i++) {

            $actual_menos= $actual_menos -1 ;
            $consultar= DB::connection('mysql')->table('banner200')->where('orden', $actual_menos)->get();
                //dd($consultar[0]);
            if($consultar[0]->estatus == 'Activo'){
                    //dd($i);
                break;
            }
        } 
            //dd($consultar);
        DB::connection('mysql')->table('banner200')
        ->where('id', $request->input('id_subir_bajar'))
        ->update(['orden' => $consultar[0]->orden]);

        DB::connection('mysql')->table('banner200')
        ->where('id', $consultar[0]->id)
        ->update(['orden' => $request->input('orden_subir_bajar')]);
        
        
        return redirect()->route('modificar_banner_200')->with('mensaje', 'Se actualizo el orden correctamente!')->with('color', 'success');
    }
    
}
public function m419()
{
    return view('errors.419');
}




public function Autorizacion_check_mantenimiento($mensaje="",$color="")
{
    $unidades = DB::connection('mysql_produc')->select('SELECT cunidades.consecutivo,cmodelos.modelo FROM cunidades 
        INNER JOIN cmodelos on cmodelos.idmodelo=cunidades.modelofkcmodelos WHERE cmodelos.idmodelo IN(3,2,4) order by cunidades.consecutivo DESC');
    $mecanicos = DB::connection('mysql_produc')->select('SELECT * FROM adatospersonal where area="MECANICO"');
    $tipo_informes = DB::connection('mysql')->select('SELECT * FROM c_tipo_informe_bitacora_liberacion ');
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
    where bitacora_liberacion_unidades.estatus='Pendiente' 
    GROUP BY 
    bitacora_liberacion_unidades.n_economico,
    detalle_falla_bitacora_liberacion_unidades.id_bitacora_liberacion;
    ";
    $query = BitacoraLiberacionUnidades::query();
    $consulta = $query->where('estatus', 'Pendiente')->get();
    $consulta_fallas = DB::connection('mysql')->select($consulta_completa);

    return view('Transmasivo.Operaciones.Autorizacion_check_mantenimiento')->with('consulta', $consulta)->with('consulta_fallas', $consulta_fallas)->with('mensaje', $mensaje)->with('color', $color);
}




}
