<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\BitacoraConductores;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\t_bitacora_terminales;
use App\Models\BitacoraLiberacionUnidades;
use DB;
use App\Models\User;
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
            SELECT 
            t1.id_jornada_sem,
            t_jornada_completa_operacion_2.servicio,
            t_jornada_completa_operacion_2.jornada,
            t_jornada_completa_operacion_2.turno,
            t1.credencial,
            u.name AS conductor,
            t1.Servicio,
            t1.ciclo,
            t1.dia,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.hora_salida END), "Sin datos") AS salida_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.comentario END), "Sin comentario") AS salida_1_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.eco END), "Sin economico") AS salida_1_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_1_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN u2.name END), "Sin Apoyo") AS apoyo_1,

            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.hora_salida END), "Sin datos") AS llegada_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.comentario END), "Sin comentario") AS salida_2_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.eco END), "Sin economico") AS salida_2_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_2_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN u2.name END), "Sin Apoyo") AS apoyo_2,

            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.hora_salida END), "Sin datos") AS salida_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.comentario END), "Sin comentario") AS salida_3_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.eco END), "Sin economico") AS salida_3_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_3_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_3,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN u2.name END), "Sin Apoyo") AS apoyo_3,
            
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.hora_salida END), "Sin datos") AS llegada_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.comentario END), "Sin comentario") AS salida_4_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.eco END), "Sin economico") AS salida_4_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_4_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_4,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN u2.name END), "Sin Apoyo") AS apoyo_4

        FROM 
            t_bitacora_terminales t1
        INNER JOIN 
            users as u ON u.id = t1.credencial 
        left JOIN 
            users as u2 ON u2.id = t1.credencial_apoyo 
        INNER JOIN 
            c_terminal ON c_terminal.id_terminal = t1.terminal
        INNER JOIN 
            t_jornada_completa_operacion_2 ON t_jornada_completa_operacion_2.id_jornada_pk = t1.id_jornada_sem
        WHERE 
            t1.dia BETWEEN "' . now()->format('Y-m-d') . ' 00:00:00" AND "' . now()->format('Y-m-d') . ' 23:59:59"
        GROUP BY 
            t1.id_jornada_sem,
            t1.credencial,
            t1.ciclo,
            t1.Servicio,
            t_jornada_completa_operacion_2.servicio,
            t_jornada_completa_operacion_2.jornada,
            t_jornada_completa_operacion_2.turno,
            t1.dia,
            u.name
        ORDER BY 
         salida_1 desc,
            t1.id_jornada_sem, 
            t1.credencial, 
            t1.ciclo,
            t1.dia;

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


        if( $diaActualEspanol=='lunes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='martes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Martes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Martes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Martes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Martes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='miercoles'  )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Miércoles" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Miércoles" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Miércoles" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Miércoles" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='jueves' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Jueves" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Jueves" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Jueves" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Jueves" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            
        }
        if($diaActualEspanol=='viernes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Viernes" AND "'.now()->format('Y-m-d').'" BETWEEN dia_inicio and dia_fin )');
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
                    if( $diaActualEspanol=='lunes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes"');
                            
                    }
                    if( $diaActualEspanol=='martes'  )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Martes"');
                            
                    }
                    if( $diaActualEspanol=='miércoles' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Miércoles"');
                            
                    }
                    if( $diaActualEspanol=='jueves'  )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Jueves"');
                            
                    }
                    if( $diaActualEspanol=='viernes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Viernes"');
                            
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
                        where id_jornada_pk="'.$id_rol_operadores[0]->id_jornada_fk.'"  ');
                    $hora_jornada_lista = [];  // Limpia el arreglo para dejarlo vacío
                    $hora_jornada_lista_mitad = [];  // Limpia el arreglo para dejarlo vacío
                    $cont=0;
                    $cont_mitad=0;
                    foreach($jornada as $jor){
                        $hora_jornada_lista[] = $jor->salida_base;
                        $cont++;
                        $cont++;
                    }
                    foreach($jornada as $jor){
                        $cont_mitad++;
                        $hora_jornada_lista_mitad[] = $jor->salida_mitad_recorrido;
                        $cont_mitad++;
                    }
                    
                    if($registro['salida_1_ter']=="Sin terminal"){
                        $registro['terminal1'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_1_ter'].' ');
                        $registro['terminal1'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_2_ter']=="Sin terminal"){
                        $registro['terminal2'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_2_ter'].' ');
                        $registro['terminal2'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_3_ter']=="Sin terminal"){
                        $registro['terminal3'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_3_ter'].' ');
                        $registro['terminal3'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_4_ter']=="Sin terminal"){
                        $registro['terminal4'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_4_ter'].' ');
                        $registro['terminal4'] = $c_terminale_1[0]->terminal;
                    }
                    

                    $posicion = $registro['ciclo'] - 1;
                    $posicion2 = $registro['ciclo'] - 1;
                    
                    if(count($hora_jornada_lista) < $registro['ciclo']){
                        
                            $registro['hora_salida_rol'] ="Fuera de jornada";
                            $registro['estatus'] ="Fuera de jornada";
                            $registro['hora_diferencia'] ="Fuera de jornada";
                            $registro['hora_salida_rol_2'] ="Fuera de jornada";
                            $registro['estatus_2'] ="Fuera de jornada";
                            $registro['hora_diferencia_2'] ="Fuera de jornada";
                    }else{
                        if($registro['salida_1']!="Sin datos" )
                        {
                            if (count($hora_jornada_lista) < ($posicion + 1)) {
                                $hora_salida_jornada = 'Fuera de jornada';
                            } else {
                                $hora_salida_jornada = $hora_jornada_lista[$posicion];
                            }
                            $hora_salida_bitacora = $registro['salida_1'];
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


                        } else{
                            $registro['hora_salida_rol'] ="No aplica";
                            $registro['estatus'] ="No aplica";
                            $registro['hora_diferencia'] ="No aplica";
                        }
                        
                        if($registro['salida_2']!="Sin datos" )
                        {
                            if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                                $hora_salida_jornada = 'Fuera de jornada';
                            } else {
                                $hora_salida_jornada = $hora_jornada_lista_mitad[$posicion2];
                            }
                            $hora_salida_bitacora = $registro['salida_2'];
                            $registro['hora_salida_rol_2'] = $hora_salida_jornada;
                            $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                            $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                            if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                                $timestamp_jornada += 86400; // 86400 seconds = 1 day
                            }
                            $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                            $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                            if ($diferencia_segundos < 0) {
                                $hora_diferencia = '+' . $hora_diferencia;
                                $registro['estatus_2'] = 'Sobretiempo';
                            } else if ($diferencia_segundos > 0){
                                $hora_diferencia = '-' . $hora_diferencia;
                                $registro['estatus_2'] = 'Retardo';
                            }else if($diferencia_segundos == 0)
                            {
                                $hora_diferencia = '+' . $hora_diferencia;
                                $registro['estatus_2'] = 'En tiempo';
                            }
                            if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                                $registro['hora_diferencia_2'] = 'Fuera de jornada';
                                $registro['estatus_2'] = 'Fuera de jornada';
                            } else {
                                $registro['hora_diferencia_2'] = $hora_diferencia;
                            }


                        } else{
                            $registro['hora_salida_rol_2'] ="No aplica";
                            $registro['estatus_2'] ="No aplica";
                            $registro['hora_diferencia_2'] ="No aplica";
                        }
                    }
                    //dd($hora_jornada_lista);
                    
                    
        }
        
        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        //dd($consulta);
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

        $jornadas_l = DB::connection('mysql')->select(
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
            AND dia_servicio IN ('Lunes')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Lunes'), 
            servicio, turno, jornada;"
        );
        
        $jornadas_combinadas_l = [];

        $consulta_l =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Lunes"',[$semana_hoy['value']]
        );
        

        $conductores_l = [];
        foreach ($consulta_l as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores_l[$key] = $conductor;
        }

        
        foreach ($jornadas_l as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores_l[$key])) {
                $jornada->conductor = $conductores_l[$key]->name. " - ". $conductores_l[$key]->id;
                $jornada->id_conductor_descanso = $conductores_l[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores_l[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas_l[] = $jornada;
        }

        //dd($jornadas_l);
        
        $conductores_l_select = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_l_select as $key => $conductor) {
            foreach ($consulta_l as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_l_select[$key]);
                }
            }
        }
        $conductores_l_select = array_values($conductores_l_select);

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
            AND dia_servicio IN ('Martes')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Martes'), 
            servicio, turno, jornada;"
        );
        
        $jornadas_combinadas_m = [];
        
        $consulta_m =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Martes"',[$semana_hoy['value']]
        );
        $conductores_m = [];
        foreach ($consulta_m as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores_m[$key] = $conductor;
        }

        foreach ($jornadas_m as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores_m[$key])) {
                $jornada->conductor = $conductores_m[$key]->name. " - ". $conductores_m[$key]->id;
                $jornada->id_conductor_descanso = $conductores_m[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores_m[$key]->dia_descanso ;
                
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas_m[] = $jornada;
        }
        //dd($jornadas_m);


        $conductores_m_select = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_m_select as $key => $conductor) {
            foreach ($consulta_m as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_m_select[$key]);
                }
            }
        }
        $conductores_m_select = array_values($conductores_m_select);


//dd($consulta_m);

        $jornadas_mi = DB::connection('mysql')->select(
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
            AND dia_servicio IN ('Miércoles')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Miércoles'), 
            servicio, turno, jornada;"
        );
        
        $jornadas_combinadas_mi = [];
        
        $consulta_mi =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Miércoles"',[$semana_hoy['value']]
        );
        $conductores_mi = [];
        foreach ($consulta_mi as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores_mi[$key] = $conductor;
        }
        foreach ($jornadas_mi as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores_mi[$key])) {
                $jornada->conductor = $conductores_mi[$key]->name. " - ". $conductores_mi[$key]->id;
                $jornada->id_conductor_descanso = $conductores_mi[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores_mi[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas_mi[] = $jornada;
        }



        $conductores_mi_select = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_mi_select as $key => $conductor) {
            foreach ($consulta_mi as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_mi_select[$key]);
                }
            }
        }
        $conductores_mi_select = array_values($conductores_mi_select);




        $jornadas_j = DB::connection('mysql')->select(
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
            AND dia_servicio IN ('Jueves')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Jueves'), 
            servicio, turno, jornada;"
        );
        
        $jornadas_combinadas_j = [];
        
        $consulta_j =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Jueves"',[$semana_hoy['value']]
        );
        
        $conductores_j = [];
        foreach ($consulta_j as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores_j[$key] = $conductor;
        }
        foreach ($jornadas_j as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores_j[$key])) {
                $jornada->conductor = $conductores_j[$key]->name. " - ". $conductores_j[$key]->id;
                $jornada->id_conductor_descanso = $conductores_j[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores_j[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas_j[] = $jornada;
        }




        $conductores_j_select = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_j_select as $key => $conductor) {
            foreach ($consulta_j as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_j_select[$key]);
                }
            }
        }
        $conductores_j_select = array_values($conductores_j_select);



        $jornadas_v = DB::connection('mysql')->select(
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
            AND dia_servicio IN ('Viernes')
            
            AND turno IN ('Vespertino','Matutino')
            GROUP BY servicio, dia_servicio, turno, jornada,id_jornada_pk
            ORDER BY FIELD(dia_servicio, 'Viernes'), 
            servicio, turno, jornada;"
        );
        
        $jornadas_combinadas_v = [];
        
        $consulta_v =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Viernes"',[$semana_hoy['value']]
        );
        
        $conductores_v = [];
        foreach ($consulta_v as $conductor) {
            $key = $conductor->servicio . '-' . $conductor->jornada . '-' . $conductor->turno . '-' . $conductor->dia_servicio;
            $conductores_v[$key] = $conductor;
        }

        foreach ($jornadas_v as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores_v[$key])) {
                $jornada->conductor = $conductores_v[$key]->name. " - ". $conductores_v[$key]->id;
                $jornada->id_conductor_descanso = $conductores_v[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores_v[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas_v[] = $jornada;
        }


        

        $conductores_v_select = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        foreach ($conductores_v_select as $key => $conductor) {
            foreach ($consulta_v as $c2) {
                if ($conductor->id == $c2->id_conductor) {
                    unset($conductores_v_select[$key]);
                }
            }
        }
        $conductores_v_select = array_values($conductores_v_select);


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
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and  dia_servicio="Lunes a Viernes"',[$semana_hoy['value']]
        );
                    //dd($consulta2);
        $consulta3 =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and dia_servicio="Sábado" ',[$semana_hoy['value']]
        );
        $consulta4 =  DB::connection('mysql')->select(
            'SELECT * from t_jornada_conductores inner join users on users.id=t_jornada_conductores.id_conductor where semana =  ? 
            AND estatus IN ("Enrolados") and dia_servicio="Domingo"',[$semana_hoy['value']]
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
        
        //dd($jornadas_m);
        $jornadas_combinadas3 = [];
        foreach ($jornadas_s as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores3[$key])) {
                $jornada->conductor = $conductores3[$key]->name. " - ". $conductores3[$key]->id; 
                $jornada->id_conductor_descanso = $conductores3[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores3[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
            }
            $jornadas_combinadas3[] = $jornada;
        }
        $jornadas_combinadas4 = [];
        foreach ($jornadas_d as $jornada) {
            $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
            if (isset($conductores4[$key])) {
                $jornada->conductor = $conductores4[$key]->name. " - ". $conductores4[$key]->id;
                $jornada->id_conductor_descanso = $conductores4[$key]->id_conductor_descanso ;
                $jornada->dia_descanso = $conductores4[$key]->dia_descanso ;
            } else {
                $jornada->conductor = 'Sin conductor';
                $jornada->id_conductor_descanso = 'Sin conductor' ;
                $jornada->dia_descanso = 'Sin descanso' ;
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

        $conductores_descanso = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
        $conductores_descanso = array_values($conductores_descanso);
        $semana_seleccionada=$semana_hoy['value'];
        $conductores_totales = count($conductores);
        //dd($jornadas_m);
        return view('Transmasivo.Operaciones.enrolar_horarios_conductores_2',
            compact('conductores_descanso','where','dia_inicio','dia_fin',
            'jornadas_l','jornadas_m','jornadas_mi','jornadas_j','jornadas_v',
            'jornadas_s','jornadas_d',
            'conductores_l_select','conductores_m_select','conductores_mi_select','conductores_j_select','conductores_v_select',
            'conductores_s',
            'conductores_d','conductores_totales','semana_seleccionada'));
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
                    $jornada->id_conductor_descanso = $conductores[$key]->id_conductor_descanso ;
                    $jornada->dia_descanso = $conductores[$key]->dia_descanso ;
                } else {
                    $jornada->conductor = 'Sin conductor';
                    $jornada->id_conductor_descanso = 'Sin conductor' ;
                    $jornada->dia_descanso = 'Sin descanso' ;
                }
                $jornadas_combinadas[] = $jornada;
            }
            //dd($jornadas_m);
            foreach ($jornadas_s as $jornada) {
                $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
                if (isset($conductores3[$key])) {
                    $jornada->conductor = $conductores3[$key]->name. " - ". $conductores3[$key]->id;
                    $jornada->id_conductor_descanso = $conductores3[$key]->id_conductor_descanso ;
                    $jornada->dia_descanso = $conductores3[$key]->dia_descanso ;
                } else {
                    $jornada->conductor = 'Sin conductor';
                    $jornada->id_conductor_descanso = 'Sin conductor' ;
                    $jornada->dia_descanso = 'Sin descanso' ;
                }
                $jornadas_combinadas[] = $jornada;
            }
            foreach ($jornadas_d as $jornada) {
                $key = $jornada->servicio . '-' . $jornada->jornada . '-' . $jornada->turno . '-' . $jornada->dia_servicio;
                if (isset($conductores4[$key])) {
                    
                    $jornada->conductor = $conductores4[$key]->name. " - ". $conductores4[$key]->id;
                    $jornada->id_conductor_descanso = $conductores4[$key]->id_conductor_descanso ;
                    $jornada->dia_descanso = $conductores4[$key]->dia_descanso ;
                } else {
                    $jornada->conductor = 'Sin conductor';
                    $jornada->id_conductor_descanso = 'Sin conductor' ;
                    $jornada->dia_descanso = 'Sin descanso' ;
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
            $dia_inicio = substr($dia_inicio, 0, 10); // Resultado: 2024-09-23
            $dia_fin = substr($dia_fin, 0, 10);      // Resultado: 2024-09-29
            $conductores_descanso = DB::connection('mysql')->select('select * from users where tipo_usuario="Conductor"');
            $conductores_descanso = array_values($conductores_descanso);
            $semana_seleccionada=$request->input('semana');
            $conductores_totales = count($conductores);
            
            return view('Transmasivo.Operaciones.enrolar_horarios_conductores_2',
                compact('where','conductores_descanso','dia_inicio','dia_fin','jornadas_m','jornadas_s','jornadas_d','conductores','conductores_s','conductores_d','conductores_totales','semana_seleccionada'));
            
        }
        if($request->has('enrolar'))
        {

            //dd($request->all());
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
            
            $conductores ;
            if($hidden_dia_servicio=='Lunes')
            {
                $conductores = $request->input('conductores_lu');
            }
            if($hidden_dia_servicio=='Martes')
            {
                $conductores = $request->input('conductores_ma');
            }
            if($hidden_dia_servicio=='Miércoles')
            {
                $conductores = $request->input('conductores_mi');
            }
            if($hidden_dia_servicio=='Jueves')
            {
                $conductores = $request->input('conductores_ju');
            }
            if($hidden_dia_servicio=='Viernes')
            {
                $conductores = $request->input('conductores_vi');
            }

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
            return redirect()->route('enrolar_horarios_conductores_2',compact('semana_seleccionada'))->with('mensaje', $mensaje)->with('color', $color)->
            with('semana_seleccionada', $semana_seleccionada)->with('hidden_servicio', $hidden_servicio)->with('hidden_dia_servicio_d', $hidden_dia_servicio);
        }
        if($request->has('enrolar_descanso'))
        {
            $hidden_id_jornada_pk_descanso = $request->input('hidden_id_jornada_pk_descanso');
            $dia_inicio_lv_descanso = $request->input('dia_inicio_lv_descanso');
            $dia_fin_lv_descanso = $request->input('dia_fin_lv_descanso');
            $dia_descanso_l_v = $request->input('dia_descanso_l_v');
            $conductores_descanso = $request->input('conductores_descanso');

            $conductores = DB::connection('mysql')->update(
                'update t_jornada_conductores set id_conductor_descanso=?,dia_descanso=?  where id_jornada_fk=? and dia_inicio=? and dia_fin=? ',
                [
                    $conductores_descanso ,
                    $dia_descanso_l_v ,
                    $hidden_id_jornada_pk_descanso ,
                    $dia_inicio_lv_descanso ,
                    $dia_fin_lv_descanso ,
                    
                ]
            );
            $mensaje="Se modifico con exito!!";
            $color="success";
            
            $semana_seleccionada=$request->input('semana_hidden_descanso');
            return redirect()->route('enrolar_horarios_conductores_2',compact('semana_seleccionada'))->with('mensaje', $mensaje)->with('color', $color)->with('semana_seleccionada', $semana_seleccionada);
        
        }if($request->has('desenrolar_jornada'))
        {
            //dd($request->all());
            
            $hidden_id_jornada_pk_descanso = $request->input('hidden_id_jornada_pk_desenrolar');
            $dia_inicio_lv_descanso = $request->input('dia_inicio_lv_desenrolar');
            $dia_fin_lv_descanso = $request->input('dia_fin_lv_desenrolar');

            $conductores = DB::connection('mysql')->update(
                'update t_jornada_conductores set estatus="Desenrolado" where id_jornada_fk=? and dia_inicio=? and dia_fin=? ',
                [
                    $hidden_id_jornada_pk_descanso ,
                    $dia_inicio_lv_descanso ,
                    $dia_fin_lv_descanso ,
                ]
            );
            $mensaje="Se elimino con exito!!";
            $color="success";
            
            $semana_seleccionada=$request->input('semana_hidden_desenrolar');
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

public function buscar_bitacora_filtro($fecha, $serv_busqueda)
{
    $where="";
    if($serv_busqueda == "")
    {
        
    }else{
        if($serv_busqueda=="TR1"){

            $where = " and t1.Servicio IN ('TR1','TR1-R') ";
        }else{
            
            $where = " and t1.Servicio = '".$serv_busqueda."' ";
        }
    }
    $consulta = DB::connection('mysql')->select('
            SELECT 
            t1.id_jornada_sem,
            t_jornada_completa_operacion_2.servicio,
            t_jornada_completa_operacion_2.jornada,
            t_jornada_completa_operacion_2.turno,
            t1.credencial,
            u.name AS conductor,
            t1.Servicio,
            t1.ciclo,
            t1.dia,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.hora_salida END), "Sin datos") AS salida_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.comentario END), "Sin comentario") AS salida_1_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.eco END), "Sin economico") AS salida_1_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_1_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN u2.name END), "Sin Apoyo") AS apoyo_1,

            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.hora_salida END), "Sin datos") AS llegada_1,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.comentario END), "Sin comentario") AS salida_2_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.eco END), "Sin economico") AS salida_2_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_2_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN u2.name END), "Sin Apoyo") AS apoyo_2,

            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.hora_salida END), "Sin datos") AS salida_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.comentario END), "Sin comentario") AS salida_3_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.eco END), "Sin economico") AS salida_3_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_3_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_3,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN u2.name END), "Sin Apoyo") AS apoyo_3,
            
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.hora_salida END), "Sin datos") AS llegada_2,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.comentario END), "Sin comentario") AS salida_4_com,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.eco END), "Sin economico") AS salida_4_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_4_eco,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_4,
            COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN u2.name END), "Sin Apoyo") AS apoyo_4

        FROM 
            t_bitacora_terminales t1
        INNER JOIN 
            users as u ON u.id = t1.credencial 
        left JOIN 
            users as u2 ON u2.id = t1.credencial_apoyo 
        INNER JOIN 
            c_terminal ON c_terminal.id_terminal = t1.terminal
        INNER JOIN 
            t_jornada_completa_operacion_2 ON t_jornada_completa_operacion_2.id_jornada_pk = t1.id_jornada_sem
        WHERE 
            t1.dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:59"  '.$where.' 
        GROUP BY 
            t1.id_jornada_sem,
            t1.credencial,
            t1.ciclo,
            t1.Servicio,
            t_jornada_completa_operacion_2.servicio,
            t_jornada_completa_operacion_2.jornada,
            t_jornada_completa_operacion_2.turno,
            t1.dia,
            u.name
        ORDER BY 
         salida_1 desc,
            t1.id_jornada_sem, 
            t1.credencial, 
            t1.ciclo,
            t1.dia;

        ');
        //dd($consulta);

        $tr1_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' .$fecha. ' 23:59:59"
        ');
        $tr1_r_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1-R" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr3_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR3" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr4_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR4" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        
        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:00" GROUP BY credencial, Servicio');
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
        $fechaCarbon = Carbon::parse($fecha);
    
        // Obtener el nombre del día de la semana
        $diaActualEspanol = $fechaCarbon->locale('es')->isoFormat('dddd'); // 'Lunes', 'Martes', etc. (en español)
    //dd($diaActualEspanol);
        
        $tr1_ciclos;
        $tr1_r_ciclos;
        $tr3_ciclos;
        $tr4_ciclos;
        $total_ciclos;


        if( $diaActualEspanol=='lunes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='martes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='miércoles'  )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='jueves' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            
        }
        if($diaActualEspanol=='viernes' )
        {
            
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='sábado'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='domingo'  )
        {
            $tr1_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');;
            $tr3_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }


        $total_ciclos = $tr1_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr4_ciclos[0]->conteo ; 
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador
        
       // dd($diaActualEspanol);
        foreach ($consulta as &$registro) {
            $id_rol_operadores;
                    if( $diaActualEspanol=='lunes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes"');
                            
                    }
                    if( $diaActualEspanol=='martes'  )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Martes"');
                            
                    }
                    if( $diaActualEspanol=='miércoles' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Miércoles"');
                            
                    }
                    if( $diaActualEspanol=='jueves'  )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Jueves"');
                            
                    }
                    if( $diaActualEspanol=='viernes' )
                    {
                        
                        $id_rol_operadores = DB::connection('mysql')->select(
                            'SELECT * FROM t_jornada_conductores 
                            where id_conductor='.$registro['credencial'].' and 
                            "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Viernes"');
                            
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
                        where id_jornada_pk="'.$id_rol_operadores[0]->id_jornada_fk.'"  ');
                    $hora_jornada_lista = [];  // Limpia el arreglo para dejarlo vacío
                    $hora_jornada_lista_mitad = [];  // Limpia el arreglo para dejarlo vacío
                    $cont=0;
                    $cont_mitad=0;
                    foreach($jornada as $jor){
                        $hora_jornada_lista[] = $jor->salida_base;
                        $cont++;
                        $cont++;
                    }
                    foreach($jornada as $jor){
                        $cont_mitad++;
                        $hora_jornada_lista_mitad[] = $jor->salida_mitad_recorrido;
                        $cont_mitad++;
                    }
                    
                    if($registro['salida_1_ter']=="Sin terminal"){
                        $registro['terminal1'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_1_ter'].' ');
                        $registro['terminal1'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_2_ter']=="Sin terminal"){
                        $registro['terminal2'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_2_ter'].' ');
                        $registro['terminal2'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_3_ter']=="Sin terminal"){
                        $registro['terminal3'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_3_ter'].' ');
                        $registro['terminal3'] = $c_terminale_1[0]->terminal;
                    }
                    if($registro['salida_4_ter']=="Sin terminal"){
                        $registro['terminal4'] = 'Sin terminal';
                    }else{
                        $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_4_ter'].' ');
                        $registro['terminal4'] = $c_terminale_1[0]->terminal;
                    }
                    

                    $posicion = $registro['ciclo'] - 1;
                    $posicion2 = $registro['ciclo'] - 1;
                    
                    if(count($hora_jornada_lista) < $registro['ciclo']){
                        
                            $registro['hora_salida_rol'] ="Fuera de jornada";
                            $registro['estatus'] ="Fuera de jornada";
                            $registro['hora_diferencia'] ="Fuera de jornada";
                            $registro['hora_salida_rol_2'] ="Fuera de jornada";
                            $registro['estatus_2'] ="Fuera de jornada";
                            $registro['hora_diferencia_2'] ="Fuera de jornada";
                    }else{
                        if($registro['salida_1']!="Sin datos" )
                        {
                            if (count($hora_jornada_lista) < ($posicion + 1)) {
                                $hora_salida_jornada = 'Fuera de jornada';
                            } else {
                                $hora_salida_jornada = $hora_jornada_lista[$posicion];
                            }
                            $hora_salida_bitacora = $registro['salida_1'];
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


                        } else{
                            $registro['hora_salida_rol'] ="No aplica";
                            $registro['estatus'] ="No aplica";
                            $registro['hora_diferencia'] ="No aplica";
                        }
                        
                        if($registro['salida_2']!="Sin datos" )
                        {
                            if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                                $hora_salida_jornada = 'Fuera de jornada';
                            } else {
                                $hora_salida_jornada = $hora_jornada_lista_mitad[$posicion2];
                            }
                            $hora_salida_bitacora = $registro['salida_2'];
                            $registro['hora_salida_rol_2'] = $hora_salida_jornada;
                            $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                            $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                            if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                                $timestamp_jornada += 86400; // 86400 seconds = 1 day
                            }
                            $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                            $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                            if ($diferencia_segundos < 0) {
                                $hora_diferencia = '+' . $hora_diferencia;
                                $registro['estatus_2'] = 'Sobretiempo';
                            } else if ($diferencia_segundos > 0){
                                $hora_diferencia = '-' . $hora_diferencia;
                                $registro['estatus_2'] = 'Retardo';
                            }else if($diferencia_segundos == 0)
                            {
                                $hora_diferencia = '+' . $hora_diferencia;
                                $registro['estatus_2'] = 'En tiempo';
                            }
                            if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                                $registro['hora_diferencia_2'] = 'Fuera de jornada';
                                $registro['estatus_2'] = 'Fuera de jornada';
                            } else {
                                $registro['hora_diferencia_2'] = $hora_diferencia;
                            }


                        } else{
                            $registro['hora_salida_rol_2'] ="No aplica";
                            $registro['estatus_2'] ="No aplica";
                            $registro['hora_diferencia_2'] ="No aplica";
                        }
                    }
                    //dd($hora_jornada_lista);
                    
                    
        }
        
        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        //dd($consulta);
        return view('Transmasivo.Operaciones.Bitacora_de_operaciones', 
        compact('terminal','fecha','total_registros', 'consulta', 'credencial','tr1_ciclos','tr1_r_ciclos','tr3_ciclos','tr4_ciclos'
        ,'total_ciclos','tr1_registro','tr1_r_registro','tr3_registro','tr4_registro'));
    
    }
public function Registro_bitacora_terminal(Request $request)
{
    //DD($request->all());
    if($request->has("pdf"))
    {
        $fecha_busqueda = $request->input('fecha_busqueda');
        return $this->generarPDF($fecha_busqueda);
    }
    if($request->has("Excel"))
    {
        $fecha_busqueda = $request->input('fecha_busqueda');
        return $this->generarExcel($fecha_busqueda);
    }
    if($request->has("Eliminar"))
    {
        $Eliminar=$request->input('modal_Eliminar');
        $id_rol_operadores = DB::connection('mysql')->select(
            'delete from t_bitacora_terminales where id_bitacora_terminales=?', [$Eliminar]
        );
        
        $mensaje="Se elimino con exito!";
        $color="success";
        return redirect()->route('Bitacora_de_operaciones')->with('mensaje', $mensaje)->with('color', $color);
    }
    if($request->has('buscar_filtro'))
    {
        $fecha = $request->input('fecha_busqueda');
        $credencial = $request->input('credencial');
        
        $serv_busqueda = $request->input('serv_busqueda');
        
       // dd($fecha);
        return $this->buscar_bitacora_filtro($fecha, $serv_busqueda);
    }
    if($request->input('buscar_filtroTR1')=='TR1')
    {
        $fecha = $request->input('fecha_busqueda');
        $credencial = $request->input('credencial');
        $serv_busqueda = 'TR1';
        return $this->buscar_bitacora_filtro($fecha, $serv_busqueda);
    }
    if($request->input('buscar_filtroTR3')=='TR3')
    {
        $fecha = $request->input('fecha_busqueda');
        $credencial = $request->input('credencial');
        $serv_busqueda = 'TR3';
        return $this->buscar_bitacora_filtro($fecha, $serv_busqueda);
    }
    if($request->input('buscar_filtroTR4')=='TR4')
    {
        $fecha = $request->input('fecha_busqueda');
        $credencial = $request->input('credencial');
        $serv_busqueda = 'TR4';
        return $this->buscar_bitacora_filtro($fecha, $serv_busqueda);
    }
    if($request->input('buscar_filtroT')=='T')
    {
        $fecha = $request->input('fecha_busqueda');
        $credencial = $request->input('credencial');
        $serv_busqueda = '';
        return $this->buscar_bitacora_filtro($fecha, $serv_busqueda);
    }
    if($request->has("Modificar"))
    {
        $hora_registrada=$request->input('hora_registrada');
        $Conductor=$request->input('Conductor');
        $Economico=$request->input('Economico');
        $modal_Modificar=$request->input('modal_Modificar');

        //dd($hora_registrada);
        $id_rol_operadores = DB::connection('mysql')->select(
            'update t_bitacora_terminales set hora_salida=? , credencial=? , eco=?  where id_bitacora_terminales=?', [$hora_registrada,$Conductor,$Economico,$modal_Modificar]
         );
         
        $mensaje="Se modifico con exito!";
        $color="success";
        return redirect()->route('Bitacora_de_operaciones')->with('mensaje', $mensaje)->with('color', $color);
    }
    else{
        $terminal=$request->input('terminal');
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
        $credencial_apoyo=$request->input('credencial_apoyo');
        


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
        if ($diaActualEspanol == 'lunes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  and estatus="Enrolados"
                AND dia_servicio = "Lunes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'martes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Martes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'miércoles') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Miércoles"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'jueves') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Jueves"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'viernes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Viernes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'sábado') {
            $id_rol_operadores = DB::connection('mysql')->select(
               'SELECT id_jornada_fk FROM t_jornada_conductores 
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  
                AND dia_servicio = "Sábado"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'domingo') {
            $id_rol_operadores = DB::connection('mysql')->select(
               'SELECT id_jornada_fk FROM t_jornada_conductores 
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  
                AND dia_servicio = "Domingo"', [$credencial, $dia]
            );
        }


        $horarios = DB::connection('mysql')->select(
            'SELECT * FROM t_jornada_completa_operacion_2 
             WHERE id_jornada_pk = ? ', [$id_rol_operadores[0]->id_jornada_fk]
         );
        $bitacora_registrada = DB::connection('mysql')->select(
            'SELECT * FROM t_bitacora_terminales 
             WHERE id_jornada_sem = ? and dia = ? ', [$id_rol_operadores[0]->id_jornada_fk , $dia]
         );
         $ciclo=1;
        
         if(count($bitacora_registrada) == 0)
         {
            $ciclo=1;
         }else{
            $conteo_ciclos  = DB::connection('mysql')->select(
                'SELECT count(*) as conteo FROM t_bitacora_terminales 
                 WHERE id_jornada_sem = ? and dia = ? and salida_entrada=?', [$id_rol_operadores[0]->id_jornada_fk , $dia, $llegada_salida]
             );
             if($conteo_ciclos[0]->conteo == 0)
             {
                
            //dd($conteo_ciclos[0]->conteo);
                $ciclo=1;
             }else{
                $ciclo= $conteo_ciclos[0]->conteo + 1 ;
             }
         }
        date_default_timezone_set('America/Mexico_City');
        $hora_actual = time();
        $hora_una_hora_atras = $hora_actual - 3600;
        $hora_formateada = date('Y-m-d H:i:s', $hora_una_hora_atras);
        if($llegada_salida == 2){

            $hora_ll=$request->input('hora_ll');
            $hora_s=$request->input('hora_s');

            $bitacora = new t_bitacora_terminales();
            $bitacora->terminal = $terminal;
            $bitacora->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->eco = $eco;
            $bitacora->dia = $dia;
            $bitacora->salida_entrada = '2';
            $bitacora->credencial = $credencial;
            $bitacora->hora_salida = $hora_ll;
            $bitacora->id_jornada_sem = $id_jornada_sem;
            $bitacora->comentario = $comentarios;
            $bitacora->ciclo = $ciclo;
            $bitacora->fecha_registro = $hora_formateada; // Fecha de registro actual
            $bitacora->credencial_apoyo = $credencial_apoyo; 
            $bitacora->id_usuario = Auth::id();
            $bitacora->save(); 

            $bitacora2 = new t_bitacora_terminales();
            $bitacora2->terminal = $terminal;
            $bitacora2->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora2->eco = $eco;
            $bitacora2->dia = $dia;
            $bitacora2->salida_entrada = '3';
            $bitacora2->credencial = $credencial;
            $bitacora2->hora_salida = $hora_s;
            $bitacora2->id_jornada_sem = $id_jornada_sem;
            $bitacora2->comentario = $comentarios;
            $bitacora2->ciclo = $ciclo;
            $bitacora2->credencial_apoyo = $credencial_apoyo; 
            $bitacora2->fecha_registro = $hora_formateada; // Fecha de registro actual
            $bitacora2->id_usuario = Auth::id();
            $bitacora2->save();    
        }else{
            $bitacora = new t_bitacora_terminales();
            $bitacora->terminal = $terminal;
            $bitacora->Servicio = $serv; // Ajusta el nombre del campo según corresponda en tu tabla
            $bitacora->eco = $eco;
            $bitacora->dia = $dia;
            $bitacora->salida_entrada = $llegada_salida;
            $bitacora->credencial = $credencial;
            $bitacora->hora_salida = $hora_salida;
            $bitacora->id_jornada_sem = $id_jornada_sem;
            $bitacora->comentario = $comentarios;
            $bitacora->credencial_apoyo = $credencial_apoyo; 
            $bitacora->ciclo = $ciclo;
            $bitacora->fecha_registro = $hora_formateada; // Fecha de registro actual
            $bitacora->id_usuario = Auth::id();
            $bitacora->save();    
        }
            
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
        if ($diaActualEspanol == 'lunes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin  and estatus="Enrolados"
                AND dia_servicio = "Lunes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'martes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Martes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'miércoles') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Miércoles"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'jueves') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Jueves"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'viernes') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Viernes"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'sábado') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
                AND dia_servicio = "Sábado"', [$credencial, $dia]
            );
        } elseif ($diaActualEspanol == 'domingo') {
            $id_rol_operadores = DB::connection('mysql')->select(
                'SELECT * FROM t_jornada_conductores 
                INNER JOIN users ON users.id=t_jornada_conductores.id_conductor
                WHERE id_conductor = ? 
                AND ? BETWEEN dia_inicio AND dia_fin   and estatus="Enrolados"
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



    public function generarExcel($fecha)
    {
        
                
        $consulta = DB::connection('mysql')->select('
        SELECT 
        t1.id_jornada_sem,
        t_jornada_completa_operacion_2.servicio,
        t_jornada_completa_operacion_2.jornada,
        t_jornada_completa_operacion_2.turno,
        t1.credencial,
        u.name AS conductor,
        t1.Servicio,
        t1.ciclo,
        t1.dia,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.hora_salida END), "Sin datos") AS salida_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.comentario END), "Sin comentario") AS salida_1_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.eco END), "Sin economico") AS salida_1_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_1_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN u2.name END), "Sin Apoyo") AS apoyo_1,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.hora_salida END), "Sin datos") AS llegada_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.comentario END), "Sin comentario") AS salida_2_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.eco END), "Sin economico") AS salida_2_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_2_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN u2.name END), "Sin Apoyo") AS apoyo_2,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.hora_salida END), "Sin datos") AS salida_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.comentario END), "Sin comentario") AS salida_3_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.eco END), "Sin economico") AS salida_3_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_3_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_3,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN u2.name END), "Sin Apoyo") AS apoyo_3,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.hora_salida END), "Sin datos") AS llegada_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.comentario END), "Sin comentario") AS salida_4_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.eco END), "Sin economico") AS salida_4_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_4_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_4,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN u2.name END), "Sin Apoyo") AS apoyo_4

        FROM 
        t_bitacora_terminales t1
        INNER JOIN 
        users as u ON u.id = t1.credencial 
        left JOIN 
        users as u2 ON u2.id = t1.credencial_apoyo 
        INNER JOIN 
        c_terminal ON c_terminal.id_terminal = t1.terminal
        INNER JOIN 
        t_jornada_completa_operacion_2 ON t_jornada_completa_operacion_2.id_jornada_pk = t1.id_jornada_sem
        WHERE 
        t1.dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:59"   
        GROUP BY 
        t1.id_jornada_sem,
        t1.credencial,
        t1.ciclo,
        t1.Servicio,
        t_jornada_completa_operacion_2.servicio,
        t_jornada_completa_operacion_2.jornada,
        t_jornada_completa_operacion_2.turno,
        t1.dia,
        u.name
        ORDER BY 
        salida_1 desc,
        t1.id_jornada_sem, 
        t1.credencial, 
        t1.ciclo,
        t1.dia;

        ');
        //dd($consulta);

        $tr1_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' .$fecha. ' 23:59:59"
        ');
        $tr1_r_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1-R" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr3_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR3" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr4_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR4" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');

        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:00" GROUP BY credencial, Servicio');
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
        $fechaCarbon = Carbon::parse($fecha);

        // Obtener el nombre del día de la semana
        $diaActualEspanol = $fechaCarbon->locale('es')->isoFormat('dddd'); // 'Lunes', 'Martes', etc. (en español)
        //dd($diaActualEspanol);

        $tr1_ciclos;
        $tr1_r_ciclos;
        $tr3_ciclos;
        $tr4_ciclos;
        $total_ciclos;


        if( $diaActualEspanol=='lunes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='martes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='miércoles'  )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');

        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='jueves' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');

        }
        if($diaActualEspanol=='viernes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='sábado'  )
        {
        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='domingo'  )
        {
        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');;
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }


        $total_ciclos = $tr1_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr4_ciclos[0]->conteo ; 
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador

        // dd($diaActualEspanol);
        foreach ($consulta as &$registro) {
        $id_rol_operadores;
                if( $diaActualEspanol=='lunes' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes"');
                        
                }
                if( $diaActualEspanol=='martes'  )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Martes"');
                        
                }
                if( $diaActualEspanol=='miércoles' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Miércoles"');
                        
                }
                if( $diaActualEspanol=='jueves'  )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Jueves"');
                        
                }
                if( $diaActualEspanol=='viernes' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Viernes"');
                        
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
                    where id_jornada_pk="'.$id_rol_operadores[0]->id_jornada_fk.'"  ');
                $hora_jornada_lista = [];  // Limpia el arreglo para dejarlo vacío
                $hora_jornada_lista_mitad = [];  // Limpia el arreglo para dejarlo vacío
                $cont=0;
                $cont_mitad=0;
                foreach($jornada as $jor){
                    $hora_jornada_lista[] = $jor->salida_base;
                    $cont++;
                    $cont++;
                }
                foreach($jornada as $jor){
                    $cont_mitad++;
                    $hora_jornada_lista_mitad[] = $jor->salida_mitad_recorrido;
                    $cont_mitad++;
                }
                
                if($registro['salida_1_ter']=="Sin terminal"){
                    $registro['terminal1'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_1_ter'].' ');
                    $registro['terminal1'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_2_ter']=="Sin terminal"){
                    $registro['terminal2'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_2_ter'].' ');
                    $registro['terminal2'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_3_ter']=="Sin terminal"){
                    $registro['terminal3'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_3_ter'].' ');
                    $registro['terminal3'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_4_ter']=="Sin terminal"){
                    $registro['terminal4'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_4_ter'].' ');
                    $registro['terminal4'] = $c_terminale_1[0]->terminal;
                }
                

                $posicion = $registro['ciclo'] - 1;
                $posicion2 = $registro['ciclo'] - 1;
                
                if(count($hora_jornada_lista) < $registro['ciclo']){
                    
                        $registro['hora_salida_rol'] ="Fuera de jornada";
                        $registro['estatus'] ="Fuera de jornada";
                        $registro['hora_diferencia'] ="Fuera de jornada";
                        $registro['hora_salida_rol_2'] ="Fuera de jornada";
                        $registro['estatus_2'] ="Fuera de jornada";
                        $registro['hora_diferencia_2'] ="Fuera de jornada";
                }else{
                    if($registro['salida_1']!="Sin datos" )
                    {
                        if (count($hora_jornada_lista) < ($posicion + 1)) {
                            $hora_salida_jornada = 'Fuera de jornada';
                        } else {
                            $hora_salida_jornada = $hora_jornada_lista[$posicion];
                        }
                        $hora_salida_bitacora = $registro['salida_1'];
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


                    } else{
                        $registro['hora_salida_rol'] ="No aplica";
                        $registro['estatus'] ="No aplica";
                        $registro['hora_diferencia'] ="No aplica";
                    }
                    
                    if($registro['salida_2']!="Sin datos" )
                    {
                        if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                            $hora_salida_jornada = 'Fuera de jornada';
                        } else {
                            $hora_salida_jornada = $hora_jornada_lista_mitad[$posicion2];
                        }
                        $hora_salida_bitacora = $registro['salida_2'];
                        $registro['hora_salida_rol_2'] = $hora_salida_jornada;
                        $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                        $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                        if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                            $timestamp_jornada += 86400; // 86400 seconds = 1 day
                        }
                        $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                        $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                        if ($diferencia_segundos < 0) {
                            $hora_diferencia = '+' . $hora_diferencia;
                            $registro['estatus_2'] = 'Sobretiempo';
                        } else if ($diferencia_segundos > 0){
                            $hora_diferencia = '-' . $hora_diferencia;
                            $registro['estatus_2'] = 'Retardo';
                        }else if($diferencia_segundos == 0)
                        {
                            $hora_diferencia = '+' . $hora_diferencia;
                            $registro['estatus_2'] = 'En tiempo';
                        }
                        if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                            $registro['hora_diferencia_2'] = 'Fuera de jornada';
                            $registro['estatus_2'] = 'Fuera de jornada';
                        } else {
                            $registro['hora_diferencia_2'] = $hora_diferencia;
                        }


                    } else{
                        $registro['hora_salida_rol_2'] ="No aplica";
                        $registro['estatus_2'] ="No aplica";
                        $registro['hora_diferencia_2'] ="No aplica";
                    }
                }
                //dd($hora_jornada_lista);
                
                
        }

        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        //dd($consulta);
       // dd($consulta);
       // return view('Transmasivo.Operaciones.Bitacora_de_operaciones', 
        //compact('terminal','total_registros', 'consulta', 'credencial','tr1_ciclos','tr1_r_ciclos','tr3_ciclos','tr4_ciclos','total_ciclos','tr1_registro','tr1_r_registro','tr3_registro','tr4_registro'));
    
        return Excel::download(new BitacoraConductores($consulta), 'Bitacora_de_terminales'.now().'.xlsx');
    }

    public function generarPDF($fecha)
    {
        
       
        $consulta = DB::connection('mysql')->select('
        SELECT 
        t1.id_jornada_sem,
        t_jornada_completa_operacion_2.servicio,
        t_jornada_completa_operacion_2.jornada,
        t_jornada_completa_operacion_2.turno,
        t1.credencial,
        u.name AS conductor,
        t1.Servicio,
        t1.ciclo,
        t1.dia,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.hora_salida END), "Sin datos") AS salida_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.comentario END), "Sin comentario") AS salida_1_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.eco END), "Sin economico") AS salida_1_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_1_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN u2.name END), "Sin Apoyo") AS apoyo_1,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.hora_salida END), "Sin datos") AS llegada_1,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.comentario END), "Sin comentario") AS salida_2_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.eco END), "Sin economico") AS salida_2_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_2_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN u2.name END), "Sin Apoyo") AS apoyo_2,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.hora_salida END), "Sin datos") AS salida_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.comentario END), "Sin comentario") AS salida_3_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.eco END), "Sin economico") AS salida_3_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_3_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_3,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN u2.name END), "Sin Apoyo") AS apoyo_3,

        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.hora_salida END), "Sin datos") AS llegada_2,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.comentario END), "Sin comentario") AS salida_4_com,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.eco END), "Sin economico") AS salida_4_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.id_bitacora_terminales END), "Sin economico") AS id_bitacora_terminales_4_eco,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.credencial_apoyo END), "Sin Apoyo") AS id_apoyo_4,
        COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN u2.name END), "Sin Apoyo") AS apoyo_4

        FROM 
        t_bitacora_terminales t1
        INNER JOIN 
        users as u ON u.id = t1.credencial 
        left JOIN 
        users as u2 ON u2.id = t1.credencial_apoyo 
        INNER JOIN 
        c_terminal ON c_terminal.id_terminal = t1.terminal
        INNER JOIN 
        t_jornada_completa_operacion_2 ON t_jornada_completa_operacion_2.id_jornada_pk = t1.id_jornada_sem
        WHERE 
        t1.dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:59"   
        GROUP BY 
        t1.id_jornada_sem,
        t1.credencial,
        t1.ciclo,
        t1.Servicio,
        t_jornada_completa_operacion_2.servicio,
        t_jornada_completa_operacion_2.jornada,
        t_jornada_completa_operacion_2.turno,
        t1.dia,
        u.name
        ORDER BY 
        salida_1 desc,
        t1.id_jornada_sem, 
        t1.credencial, 
        t1.ciclo,
        t1.dia;

        ');
        //dd($consulta);

        $tr1_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' .$fecha. ' 23:59:59"
        ');
        $tr1_r_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR1-R" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr3_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR3" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');
        $tr4_registro =DB::connection('mysql')->select('
        select count(*) as conteo from t_bitacora_terminales  
        WHERE Servicio="TR4" AND dia BETWEEN "' . $fecha . ' 00:00:00"  AND "' . $fecha . ' 23:59:59"
        ');

        $credenciales_registradas = DB::connection('mysql')->select('SELECT Servicio, credencial, COUNT(*) AS cantidad 
        FROM t_bitacora_terminales 
        WHERE dia BETWEEN "' . $fecha . ' 00:00:00" AND "' . $fecha . ' 23:59:00" GROUP BY credencial, Servicio');
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
        $fechaCarbon = Carbon::parse($fecha);

        // Obtener el nombre del día de la semana
        $diaActualEspanol = $fechaCarbon->locale('es')->isoFormat('dddd'); // 'Lunes', 'Martes', etc. (en español)
        //dd($diaActualEspanol);

        $tr1_ciclos;
        $tr1_r_ciclos;
        $tr3_ciclos;
        $tr4_ciclos;
        $total_ciclos;


        if( $diaActualEspanol=='lunes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Lunes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='martes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Martes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='miércoles'  )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');

        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Miércoles" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='jueves' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Jueves" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');

        }
        if($diaActualEspanol=='viernes' )
        {

        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Viernes" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='sábado'  )
        {
        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Sábado" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }
        if( $diaActualEspanol=='domingo'  )
        {
        $tr1_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');;
        $tr3_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" AND dia_servicio="Domingo" AND "'.$fecha.'" BETWEEN dia_inicio and dia_fin )');
        }


        $total_ciclos = $tr1_ciclos[0]->conteo + $tr1_r_ciclos[0]->conteo + $tr3_ciclos[0]->conteo + $tr4_ciclos[0]->conteo ; 
        $recorridos = []; // Array para almacenar los recorridos por id_rol_operador

        // dd($diaActualEspanol);
        foreach ($consulta as &$registro) {
        $id_rol_operadores;
                if( $diaActualEspanol=='lunes' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Lunes"');
                        
                }
                if( $diaActualEspanol=='martes'  )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Martes"');
                        
                }
                if( $diaActualEspanol=='miércoles' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Miércoles"');
                        
                }
                if( $diaActualEspanol=='jueves'  )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Jueves"');
                        
                }
                if( $diaActualEspanol=='viernes' )
                {
                    
                    $id_rol_operadores = DB::connection('mysql')->select(
                        'SELECT * FROM t_jornada_conductores 
                        where id_conductor='.$registro['credencial'].' and 
                        "'.$registro['dia'].'" BETWEEN dia_inicio and dia_fin  and dia_servicio="Viernes"');
                        
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
                    where id_jornada_pk="'.$id_rol_operadores[0]->id_jornada_fk.'"  ');
                $hora_jornada_lista = [];  // Limpia el arreglo para dejarlo vacío
                $hora_jornada_lista_mitad = [];  // Limpia el arreglo para dejarlo vacío
                $cont=0;
                $cont_mitad=0;
                foreach($jornada as $jor){
                    $hora_jornada_lista[] = $jor->salida_base;
                    $cont++;
                    $cont++;
                }
                foreach($jornada as $jor){
                    $cont_mitad++;
                    $hora_jornada_lista_mitad[] = $jor->salida_mitad_recorrido;
                    $cont_mitad++;
                }
                
                if($registro['salida_1_ter']=="Sin terminal"){
                    $registro['terminal1'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_1_ter'].' ');
                    $registro['terminal1'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_2_ter']=="Sin terminal"){
                    $registro['terminal2'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_2_ter'].' ');
                    $registro['terminal2'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_3_ter']=="Sin terminal"){
                    $registro['terminal3'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_3_ter'].' ');
                    $registro['terminal3'] = $c_terminale_1[0]->terminal;
                }
                if($registro['salida_4_ter']=="Sin terminal"){
                    $registro['terminal4'] = 'Sin terminal';
                }else{
                    $c_terminale_1 = DB::connection('mysql')->select('SELECT terminal FROM c_terminal where id_terminal='.$registro['salida_4_ter'].' ');
                    $registro['terminal4'] = $c_terminale_1[0]->terminal;
                }
                

                $posicion = $registro['ciclo'] - 1;
                $posicion2 = $registro['ciclo'] - 1;
                
                if(count($hora_jornada_lista) < $registro['ciclo']){
                    
                        $registro['hora_salida_rol'] ="Fuera de jornada";
                        $registro['estatus'] ="Fuera de jornada";
                        $registro['hora_diferencia'] ="Fuera de jornada";
                        $registro['hora_salida_rol_2'] ="Fuera de jornada";
                        $registro['estatus_2'] ="Fuera de jornada";
                        $registro['hora_diferencia_2'] ="Fuera de jornada";
                }else{
                    if($registro['salida_1']!="Sin datos" )
                    {
                        if (count($hora_jornada_lista) < ($posicion + 1)) {
                            $hora_salida_jornada = 'Fuera de jornada';
                        } else {
                            $hora_salida_jornada = $hora_jornada_lista[$posicion];
                        }
                        $hora_salida_bitacora = $registro['salida_1'];
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


                    } else{
                        $registro['hora_salida_rol'] ="No aplica";
                        $registro['estatus'] ="No aplica";
                        $registro['hora_diferencia'] ="No aplica";
                    }
                    
                    if($registro['salida_2']!="Sin datos" )
                    {
                        if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                            $hora_salida_jornada = 'Fuera de jornada';
                        } else {
                            $hora_salida_jornada = $hora_jornada_lista_mitad[$posicion2];
                        }
                        $hora_salida_bitacora = $registro['salida_2'];
                        $registro['hora_salida_rol_2'] = $hora_salida_jornada;
                        $timestamp_jornada = strtotime($hora_salida_jornada);//menor
                        $timestamp_bitacora = strtotime($hora_salida_bitacora);//mayor
                        if ($timestamp_jornada < strtotime('03:00:00') && $timestamp_bitacora > strtotime('03:00:00')) {
                            $timestamp_jornada += 86400; // 86400 seconds = 1 day
                        }
                        $diferencia_segundos = $timestamp_bitacora - $timestamp_jornada;
                        $hora_diferencia = gmdate('H:i:s', abs($diferencia_segundos));
                        if ($diferencia_segundos < 0) {
                            $hora_diferencia = '+' . $hora_diferencia;
                            $registro['estatus_2'] = 'Sobretiempo';
                        } else if ($diferencia_segundos > 0){
                            $hora_diferencia = '-' . $hora_diferencia;
                            $registro['estatus_2'] = 'Retardo';
                        }else if($diferencia_segundos == 0)
                        {
                            $hora_diferencia = '+' . $hora_diferencia;
                            $registro['estatus_2'] = 'En tiempo';
                        }
                        if (count($hora_jornada_lista_mitad) < ($posicion2 + 1)) {
                            $registro['hora_diferencia_2'] = 'Fuera de jornada';
                            $registro['estatus_2'] = 'Fuera de jornada';
                        } else {
                            $registro['hora_diferencia_2'] = $hora_diferencia;
                        }


                    } else{
                        $registro['hora_salida_rol_2'] ="No aplica";
                        $registro['estatus_2'] ="No aplica";
                        $registro['hora_diferencia_2'] ="No aplica";
                    }
                }
                //dd($hora_jornada_lista);
                
                
        }

        $tr1_registro = $tr1_registro[0]->conteo/2;
        $tr1_r_registro = $tr1_r_registro[0]->conteo/2;
        $tr3_registro = $tr3_registro[0]->conteo/2;
        $tr4_registro = $tr4_registro[0]->conteo/2;
        $total_registros = $tr1_registro +$tr1_r_registro +$tr3_registro +$tr4_registro ;
        //dd($consulta);
    //dd($consulta);
    //return view('Transmasivo.Operaciones.Bitacora_de_operaciones', 
    //compact('terminal','total_registros', 'consulta', 'credencial','tr1_ciclos','tr1_r_ciclos','tr3_ciclos','tr4_ciclos','total_ciclos','tr1_registro','tr1_r_registro','tr3_registro','tr4_registro'));


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


public function Reporte_de_jornadas()
{
    $hoy = Carbon::today();
    $lunes = $hoy->copy()->startOfWeek();
    $diasSemana = [
            'lunes' => $lunes->copy()->format('Y-m-d'),
            'martes' => $lunes->copy()->addDay()->format('Y-m-d'),
            'miercoles' => $lunes->copy()->addDays(2)->format('Y-m-d'),
            'jueves' => $lunes->copy()->addDays(3)->format('Y-m-d'),
            'viernes' => $lunes->copy()->addDays(4)->format('Y-m-d'),
            'sabado' => $lunes->copy()->addDays(5)->format('Y-m-d'),
            'domingo' => $lunes->copy()->addDays(6)->format('Y-m-d'),
        ];
       
        $registro_l_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');

        $registro_m_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
         
        $registro_mi_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
         
        $registro_j_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        
        $registro_v_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
         
        $registro_s_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
         
        $registro_d_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
    
        
        $registro_t_l = ($registro_l_tr4[0]->conteo * 22.5) +($registro_l_tr1[0]->conteo * 33.6) 
        +($registro_l_tr1_r[0]->conteo * 33.6) + ($registro_l_tr3[0]->conteo * 33.6);

        $registro_t_m = ($registro_m_tr4[0]->conteo * 22.5) +($registro_m_tr1[0]->conteo * 33.6) 
        +($registro_m_tr1_r[0]->conteo * 33.6) + ($registro_m_tr3[0]->conteo * 33.6);
        
        $registro_t_mi = ($registro_mi_tr4[0]->conteo * 22.5) +($registro_mi_tr1[0]->conteo * 33.6) 
        +($registro_mi_tr1_r[0]->conteo * 33.6) + ($registro_mi_tr3[0]->conteo * 33.6);
        
        $registro_t_j = ($registro_j_tr4[0]->conteo * 22.5) +($registro_j_tr1[0]->conteo * 33.6) 
        +($registro_j_tr1_r[0]->conteo * 33.6) + ($registro_j_tr3[0]->conteo * 33.6);
        
        $registro_t_v = ($registro_v_tr4[0]->conteo * 22.5) +($registro_v_tr1[0]->conteo * 33.6) 
        +($registro_v_tr1_r[0]->conteo * 33.6) + ($registro_v_tr3[0]->conteo * 33.6);
        
        $registro_t_s = ($registro_s_tr4[0]->conteo * 22.5) +($registro_s_tr1[0]->conteo * 33.6) 
        +($registro_s_tr1_r[0]->conteo * 33.6) + ($registro_s_tr3[0]->conteo * 33.6);
        
        $registro_t_d = ($registro_d_tr4[0]->conteo * 22.5) +($registro_d_tr1[0]->conteo * 33.6) 
        +($registro_d_tr1_r[0]->conteo * 33.6) + ($registro_d_tr3[0]->conteo * 33.6);

        $tr1_ciclos_l;
        $tr1_r_ciclos_l;
        $tr3_ciclos_l;
        $tr4_ciclos_l;
        
        $tr1_ciclos_m;
        $tr1_r_ciclos_m;
        $tr3_ciclos_m;
        $tr4_ciclos_m;
        
        $tr1_ciclos_mi;
        $tr1_r_ciclos_mi;
        $tr3_ciclos_mi;
        $tr4_ciclos_mi;
        
        $tr1_ciclos_j;
        $tr1_r_ciclos_j;
        $tr3_ciclos_j;
        $tr4_ciclos_j;
        
        $tr1_ciclos_v;
        $tr1_r_ciclos_v;
        $tr3_ciclos_v;
        $tr4_ciclos_v;

        $tr1_ciclos_s ;
        $tr1_r_ciclos_s ;
        $tr3_ciclos_s ;
        $tr4_ciclos_s ;

        $tr1_ciclos_d;
        $tr1_r_ciclos_d;
        $tr3_ciclos_d;
        $tr4_ciclos_d;

        $total_ciclos;

        $fecha_busqueda =now()->format('Y-m-d') ;
    
        $tr1_ciclos_l = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Lunes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos_l = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Lunes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos_l = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Lunes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos_l = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Lunes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
   
        $tr1_ciclos_m = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Martes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos_m = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Martes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos_m = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Martes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos_m = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Martes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Martes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
   
        $tr1_ciclos_mi = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Miércoles" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos_mi = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Miércoles" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos_mi = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Miércoles" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos_mi = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Miércoles" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Miércoles" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
   
        $tr1_ciclos_j = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Jueves" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos_j = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Jueves" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos_j = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Jueves" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos_j = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Jueves" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Jueves" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
   
        $tr1_ciclos_v = DB::connection('mysql')->select('
        SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr1_r_ciclos_v = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR1-R" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr3_ciclos_v = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR3" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
        $tr4_ciclos_v = DB::connection('mysql')->select('
        SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Viernes" and servicio="TR4" and id_jornada_pk in
        (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
   
            $tr1_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
       
            $tr1_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');;
            $tr3_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
       
    
        $total_km_tr1_l = ($tr1_ciclos_l[0]->conteo * 33.6) + ($tr1_r_ciclos_l[0]->conteo * 33.6) + ($tr3_ciclos_l[0]->conteo * 33.6) + ($tr4_ciclos_l[0]->conteo * 22.5) ;
        $total_km_tr1_m = ($tr1_ciclos_m[0]->conteo * 33.6) + ($tr1_r_ciclos_m[0]->conteo * 33.6) + ($tr3_ciclos_m[0]->conteo * 33.6) + ($tr4_ciclos_m[0]->conteo * 22.5) ;
        $total_km_tr1_mi = ($tr1_ciclos_mi[0]->conteo * 33.6) + ($tr1_r_ciclos_mi[0]->conteo * 33.6) + ($tr3_ciclos_mi[0]->conteo * 33.6) + ($tr4_ciclos_mi[0]->conteo * 22.5) ;
        $total_km_tr1_j = ($tr1_ciclos_j[0]->conteo * 33.6) + ($tr1_r_ciclos_j[0]->conteo * 33.6) + ($tr3_ciclos_j[0]->conteo * 33.6) + ($tr4_ciclos_j[0]->conteo * 22.5) ;
        $total_km_tr1_v = ($tr1_ciclos_v[0]->conteo * 33.6) + ($tr1_r_ciclos_v[0]->conteo * 33.6) + ($tr3_ciclos_v[0]->conteo * 33.6) + ($tr4_ciclos_v[0]->conteo * 22.5) ;
        $total_km_tr1_s = ($tr1_ciclos_s[0]->conteo * 33.6) + ($tr1_r_ciclos_s[0]->conteo * 33.6) + ($tr3_ciclos_s[0]->conteo * 33.6) + ($tr4_ciclos_s[0]->conteo * 22.5) ;
        $total_km_tr1_d = ($tr1_ciclos_d[0]->conteo * 33.6) + ($tr1_r_ciclos_d[0]->conteo * 33.6) + ($tr3_ciclos_d[0]->conteo * 33.6) + ($tr4_ciclos_d[0]->conteo * 22.5) ;
       // dd($total_km_tr1_l);
        $total_ciclos_l = ($tr1_ciclos_l[0]->conteo + $tr1_r_ciclos_l[0]->conteo + $tr3_ciclos_l[0]->conteo + $tr4_ciclos_l[0]->conteo)*1 ; 
        $total_ciclos_m = ($tr1_ciclos_m[0]->conteo + $tr1_r_ciclos_m[0]->conteo + $tr3_ciclos_m[0]->conteo + $tr4_ciclos_m[0]->conteo)*1 ; 
        $total_ciclos_mi = ($tr1_ciclos_mi[0]->conteo + $tr1_r_ciclos_mi[0]->conteo + $tr3_ciclos_mi[0]->conteo + $tr4_ciclos_mi[0]->conteo)*1 ; 
        $total_ciclos_j = ($tr1_ciclos_j[0]->conteo + $tr1_r_ciclos_j[0]->conteo + $tr3_ciclos_j[0]->conteo + $tr4_ciclos_j[0]->conteo)*1 ; 
        $total_ciclos_v = ($tr1_ciclos_v[0]->conteo + $tr1_r_ciclos_v[0]->conteo + $tr3_ciclos_v[0]->conteo + $tr4_ciclos_v[0]->conteo)*1 ; 
        $total_ciclos_s = $tr1_ciclos_s[0]->conteo + $tr1_r_ciclos_s[0]->conteo + $tr3_ciclos_s[0]->conteo + $tr4_ciclos_s[0]->conteo ; 
        $total_ciclos_d = $tr1_ciclos_d[0]->conteo + $tr1_r_ciclos_d[0]->conteo + $tr3_ciclos_d[0]->conteo + $tr4_ciclos_d[0]->conteo ; 

        $consulta_l = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['lunes'] . ' 00:00:00" AND "' .  $diasSemana['lunes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_m = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['martes'] . ' 00:00:00" AND "' .  $diasSemana['martes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_mi = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['miercoles'] . ' 00:00:00" AND "' .  $diasSemana['miercoles'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_j = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['jueves'] . ' 00:00:00" AND "' .  $diasSemana['jueves'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        //dd($consulta_j);
        $consulta_v = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['viernes'] . ' 00:00:00" AND "' .  $diasSemana['viernes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        
        $consulta_s = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['sabado'] . ' 00:00:00" AND "' .  $diasSemana['sabado'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_d = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['domingo'] . ' 00:00:00" AND "' .  $diasSemana['domingo'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        
        $registro_l = count($consulta_l);
        $registro_m = count($consulta_m);
        $registro_mi = count($consulta_mi);
        $registro_j = count($consulta_j);
        $registro_v = count($consulta_v);
        $registro_s = count($consulta_s);
        $registro_d = count($consulta_d);

        $Ojo_De_Agua_1 = 0; 
        $Esmeralda_1 = 1.47; 
        $Cuauhtemoc_Norte_1 = 2; 
        $Cuauhtemoc_Sur_1 = 3.05; 
        $Hidalgo_1 = 3.58; 
        $Insurgentes_1 = 4.39; 
        $Central_De_Abastos_1 = 5.3; 
        $e_19_De_Septiembre_1 = 6.62; 
        $Palomas_1 = 7.6; 
        $Jardines_De_Morelos_1 = 8; 
        $Aquiles_Serdan_1 = 8.26; 
        $Hospital_1 = 8.77; 
        $e_1ro_De_Mayo_1 = 9.6; 
        $Las_Americas_1 = 10.55; 
        $Valle_De_Ecatepec_1 = 11.64; 
        $Vocacional_3_1 = 12.4; 
        $Adolfo_Lopez_Mateos_1 = 12.5; 
        $Zodiaco_1 = 13; 
        $Alfredo_Torres_1 = 13.58; 
        $Unitec_1 = 14.02; 
        $Estacion_Industrial_1 = 14.5; 
        $Josefa_Ortiz_De_Dominguez_1 = 15; 
        $Quinto_Sol_1 = 15.83; 
        $Ciudad_Azteca_1 = 16.5; 

        $Ojo_De_Agua_2 = 17.1; 
        $Esmeralda_2 = 15; 
        $Cuauhtemoc_Norte_2 = 14.5; 
        $Cuauhtemoc_Sur_2 = 13.47; 
        $Hidalgo_2 = 12.9; 
        $Insurgentes_2 = 12.04; 
        $Central_De_Abastos_2 = 11.3; 
        $e_19_De_Septiembre_2 = 9.8; 
        $Palomas_2 = 9.39; 
        $Jardines_De_Morelos_2 = 8.45; 
        $Aquiles_Serdan_2 = 8.18; 
        $Hospital_2 = 7.66; 
        $e_1ro_De_Mayo_2 = 6.73; 
        $Las_Americas_2 = 5.88; 
        $Valle_De_Ecatepec_2 = 4.8; 
        $Vocacional_3_2 = 4.31; 
        $Adolfo_Lopez_Mateos_2 = 3.93; 
        $Zodiaco_2 = 3.45; 
        $Alfredo_Torres_2 = 2.86; 
        $Unitec_2 = 2.34; 
        $Estacion_Industrial_2 = 1.86; 
        $Josefa_Ortiz_De_Dominguez_2 = 1.41; 
        $Quinto_Sol_2 = 0.6; 
        $Ciudad_Azteca_2 = 0; 

   // dd($consulta_l);
    $salida_1=0;
    $salida_2=0;
    $salida_3=0;
    $salida_4=0;
    $km_1_l;
    $km_2_l;
    $km_t_l=0;

    $km_1_m;
    $km_2_m;
    $km_t_m=0;

    $km_1_mi;
    $km_2_mi;
    $km_t_mi=0;

    $km_1_j;
    $km_2_j;
    $km_t_j=0;

    $km_1_v;
    $km_2_v;
    $km_t_v=0;

    $km_1_s;
    $km_2_s;
    $km_t_s=0;

    $km_1_d;
    $km_2_d;
    $km_t_d=0;

    for($i = 0 ;  count($consulta_l) > $i ; $i++ )
    {
        $km_1_l= 0;
        $km_2_l= 0;
        if( $consulta_l[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_l[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_l[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_l[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_l[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_l[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_l[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_l[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_l[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_l[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_l[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_l[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_l[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_l[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_l[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_l[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_l[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_l[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_l[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_l[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_l[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_l[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_l[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_l[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_l[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_l[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_l[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_l[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_l[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_l[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_l[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_l[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_l[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_l[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_l[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_l[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_l[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_l[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_l[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_l[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_l[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_l[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_l[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_l[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_l[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_l[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_l[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_l[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_l[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_l = $llegada_2 - $salida_1;
        }
        if( $consulta_l[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_l[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_l[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_l[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_l[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_l[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_l[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_l[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_l[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_l[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_l[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_l[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_l[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_l[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_l[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_l[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_l[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_l[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_l[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_l[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_l[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_l[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_l[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_l[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_l[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_l[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_l[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_l[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_l[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_l[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_l[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_l[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_l[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_l[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_l[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_l[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_l[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_l[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_l[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_l[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_l[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_l[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_l[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_l[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_l[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_l[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_l[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_l[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_l[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_l = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_l = $km_t_l + $km_1_l + $km_2_l;
    }

    for($i = 0 ;  count($consulta_m) > $i ; $i++ )
    {
        $km_1_m= 0;
        $km_2_m= 0;
        if($consulta_m[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_m[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_m[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_m[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_m[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_m[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_m[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_m[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_m[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_m[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_m[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_m[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_m[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_m[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_m[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_m[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_m[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_m[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_m[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_m[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_m[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_m[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_m[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_m[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_m[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_m[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_m[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_m[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_m[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_m[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_m[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_m[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_m[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_m[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_m[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_m[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_m[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_m[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_m[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_m[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_m[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_m[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_m[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_m[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_m[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_m[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_m[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_m[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_m[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_m = $llegada_2 - $salida_1;
        }
        if($consulta_m[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_m[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_m[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_m[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_m[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_m[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_m[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_m[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_m[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_m[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_m[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_m[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_m[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_m[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_m[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_m[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_m[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_m[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_m[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_m[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_m[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_m[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_m[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_m[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_m[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_m[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_m[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_m[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_m[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_m[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_m[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_m[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_m[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_m[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_m[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_m[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_m[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_m[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_m[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_m[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_m[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_m[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_m[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_m[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_m[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_m[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_m[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_m[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_m[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_m = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_m = $km_t_m + $km_1_m + $km_2_m;
    }
    for($i = 0 ;  count($consulta_mi) > $i ; $i++ )
    {
        $km_1_mi= 0;
        $km_2_mi= 0;
        if($consulta_mi[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_mi[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_mi[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_mi[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_mi[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_mi[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_mi[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_mi[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_mi[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_mi[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_mi[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_mi[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_mi[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_mi[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_mi[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_mi[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_mi[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_mi[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_mi[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_mi[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_mi[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_mi[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_mi[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_mi[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_mi[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_mi[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_mi[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_mi[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_mi[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_mi[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_mi[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_mi[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_mi[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_mi[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_mi[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_mi[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_mi[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_mi[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_mi[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_mi[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_mi[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_mi[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_mi[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_mi[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_mi[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_mi[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_mi[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_mi[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_mi[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_mi = $llegada_2 - $salida_1;
        }
        if( $consulta_mi[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_mi[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_mi[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_mi[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_mi[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_mi[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_mi[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_mi[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_mi[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_mi[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_mi[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_mi[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_mi[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_mi[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_mi[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_mi[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_mi[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_mi[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_mi[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_mi[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_mi[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_mi[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_mi[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_mi[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_mi[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_mi[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_mi[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_mi[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_mi[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_mi[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_mi[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_mi[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_mi[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_mi[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_mi[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_mi[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_mi[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_mi[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_mi[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_mi[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_mi[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_mi[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_mi[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_mi[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_mi[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_mi[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_mi[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_mi[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_mi[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_mi = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_mi = $km_t_mi + $km_1_mi + $km_2_mi;
    }


    for($i = 0 ;  count($consulta_j) > $i ; $i++ )
    {
        $km_1_j= 0;
        $km_2_j= 0;
        if( $consulta_j[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_j[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_j[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_j[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_j[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_j[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_j[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_j[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_j[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_j[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_j[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_j[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_j[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_j[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_j[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_j[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_j[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_j[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_j[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_j[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_j[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_j[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_j[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_j[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_j[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_j[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_j[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_j[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_j[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_j[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_j[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_j[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_j[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_j[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_j[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_j[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_j[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_j[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_j[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_j[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_j[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_j[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_j[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_j[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_j[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_j[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_j[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_j[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_j[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_j = $llegada_2 - $salida_1;
        }
        if( $consulta_j[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_j[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_j[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_j[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_j[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_j[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_j[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_j[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_j[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_j[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_j[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_j[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_j[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_j[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_j[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_j[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_j[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_j[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_j[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_j[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_j[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_j[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_j[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_j[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_j[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_j[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_j[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_j[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_j[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_j[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_j[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_j[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_j[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_j[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_j[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_j[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_j[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_j[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_j[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_j[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_j[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_j[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_j[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_j[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_j[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_j[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_j[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_j[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_j[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_j = $llegada_2 - $salida_2;
                
            
        }
        //dd($km_2_j);
        $km_t_j = $km_t_j + $km_1_j + $km_2_j;
    }


    for($i = 0 ;  count($consulta_v) > $i ; $i++ )
    {
        $km_1_v= 0;
        $km_2_v= 0;
        if( $consulta_v[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_v[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_v[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_v[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_v[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_v[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_v[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_v[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_v[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_v[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_v[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_v[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_v[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_v[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_v[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_v[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_v[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_v[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_v[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_v[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_v[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_v[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_v[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_v[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_v[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_v[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_v[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_v[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_v[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_v[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_v[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_v[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_v[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_v[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_v[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_v[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_v[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_v[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_v[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_v[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_v[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_v[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_v[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_v[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_v[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_v[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_v[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_v[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_v[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_v = $llegada_2 - $salida_1;
        }
        if( $consulta_v[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_v[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_v[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_v[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_v[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_v[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_v[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_v[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_v[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_v[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_v[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_v[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_v[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_v[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_v[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_v[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_v[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_v[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_v[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_v[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_v[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_v[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_v[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_v[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_v[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_v[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_v[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_v[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_v[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_v[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_v[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_v[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_v[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_v[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_v[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_v[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_v[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_v[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_v[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_v[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_v[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_v[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_v[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_v[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_v[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_v[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_v[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_v[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_v[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_v = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_v = $km_t_v + $km_1_v + $km_2_v;
    }


    for($i = 0 ;  count($consulta_s) > $i ; $i++ )
    {
        $km_1_s= 0;
        $km_2_s= 0;
        if(  $consulta_s[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_s[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_s[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_s[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_s[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_s[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_s[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_s[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_s[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_s[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_s[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_s[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_s[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_s[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_s[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_s[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_s[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_s[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_s[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_s[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_s[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_s[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_s[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_s[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_s[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_s[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_s[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_s[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_s[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_s[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_s[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_s[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_s[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_s[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_s[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_s[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_s[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_s[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_s[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_s[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_s[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_s[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_s[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_s[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_s[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_s[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_s[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_s[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_s[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_s = $llegada_2 - $salida_1;
        }
        if( $consulta_s[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_s[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_s[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_s[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_s[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_s[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_s[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_s[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_s[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_s[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_s[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_s[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_s[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_s[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_s[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_s[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_s[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_s[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_s[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_s[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_s[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_s[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_s[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_s[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_s[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_s[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_s[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_s[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_s[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_s[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_s[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_s[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_s[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_s[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_s[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_s[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_s[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_s[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_s[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_s[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_s[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_s[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_s[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_s[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_s[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_s[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_s[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_s[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_s[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_s = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_s = $km_t_s + $km_1_s + $km_2_s;
    }

    for($i = 0 ;  count($consulta_d) > $i ; $i++ )
    {
        $km_1_d= 0;
        $km_2_d= 0;
        if( $consulta_d[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_d[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_d[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_d[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_d[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_d[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_d[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_d[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_d[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_d[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_d[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_d[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_d[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_d[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_d[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_d[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_d[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_d[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_d[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_d[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_d[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_d[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_d[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_d[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_d[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_d[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_d[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_d[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_d[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_d[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_d[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_d[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_d[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_d[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_d[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_d[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_d[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_d[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_d[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_d[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_d[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_d[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_d[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_d[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_d[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_d[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_d[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_d[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_d[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_d = $llegada_2 - $salida_1;
        }
        if( $consulta_d[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_d[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_d[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_d[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_d[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_d[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_d[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_d[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_d[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_d[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_d[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_d[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_d[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_d[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_d[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_d[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_d[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_d[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_d[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_d[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_d[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_d[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_d[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_d[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_d[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_d[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_d[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_d[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_d[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_d[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_d[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_d[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_d[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_d[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_d[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_d[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_d[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_d[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_d[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_d[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_d[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_d[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_d[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_d[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_d[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_d[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_d[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_d[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_d[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_d = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_d = $km_t_d + $km_1_d + $km_2_d;
    }
    //dd($km_t_mi);
    $km_t_l_no = $total_km_tr1_l - $km_t_l;
    $km_t_m_no = $total_km_tr1_m - $km_t_m;
    $km_t_mi_no = $total_km_tr1_mi - $km_t_mi;
    $km_t_j_no = $total_km_tr1_j - $km_t_j;
    $km_t_v_no = $total_km_tr1_v - $km_t_v;
    $km_t_s_no = $total_km_tr1_s - $km_t_s;
    $km_t_d_no = $total_km_tr1_d - $km_t_d;

    return view('Transmasivo.Operaciones.Reporte_de_jornadas',
    compact('km_t_l_no','km_t_m_no','km_t_mi_no','km_t_j_no','km_t_v_no','km_t_s_no','km_t_d_no',
    'km_t_l','km_t_m','km_t_mi','km_t_j','km_t_v','km_t_s','km_t_d','registro_l','registro_m','registro_mi','registro_j','registro_v'
    ,'total_km_tr1_l','total_km_tr1_m','total_km_tr1_mi','total_km_tr1_j','total_km_tr1_v','total_km_tr1_s','total_km_tr1_d'
    ,'registro_t_l','registro_t_m','registro_t_mi','registro_t_j','registro_t_v','registro_t_s','registro_t_d'
    ,'registro_s','registro_d','total_ciclos_l','total_ciclos_m','total_ciclos_mi','total_ciclos_j','total_ciclos_v','total_ciclos_s','total_ciclos_d'));

}

public function postReporte_de_jornadas(Request $request)
{
    if($request->has('imagenBase64'))
    {
        $hoy = Carbon::today();
    $lunes = $hoy->copy()->startOfWeek();
    $diasSemana = [
            'lunes' => $lunes->copy()->format('Y-m-d'),
            'martes' => $lunes->copy()->addDay()->format('Y-m-d'),
            'miercoles' => $lunes->copy()->addDays(2)->format('Y-m-d'),
            'jueves' => $lunes->copy()->addDays(3)->format('Y-m-d'),
            'viernes' => $lunes->copy()->addDays(4)->format('Y-m-d'),
            'sabado' => $lunes->copy()->addDays(5)->format('Y-m-d'),
            'domingo' => $lunes->copy()->addDays(6)->format('Y-m-d'),
        ];
        $registro_l =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"
            ');
        $registro_m =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"
            ');
        $registro_mi =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"
            ');
        $registro_j =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"
            ');
        $registro_v =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"
            ');
        $registro_s =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"
            ');
        $registro_d =DB::connection('mysql')->select('
            select count(*) as conteo from t_bitacora_terminales  
            WHERE  dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"
            ');
        $registro_l_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');
        $registro_l_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['lunes'] . ' 00:00:00"  AND "' . $diasSemana['lunes'] . ' 23:59:59"');

        $registro_m_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
        $registro_m_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
         WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['martes'] . ' 00:00:00"  AND "' . $diasSemana['martes'] . ' 23:59:59"');
         
        $registro_mi_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
        $registro_mi_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['miercoles'] . ' 00:00:00"  AND "' . $diasSemana['miercoles'] . ' 23:59:59"');
         
        $registro_j_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
        $registro_j_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['jueves'] . ' 00:00:00"  AND "' . $diasSemana['jueves'] . ' 23:59:59"');
         
        $registro_v_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
        $registro_v_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['viernes'] . ' 00:00:00"  AND "' . $diasSemana['viernes'] . ' 23:59:59"');
         
        $registro_s_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
        $registro_s_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['sabado'] . ' 00:00:00"  AND "' . $diasSemana['sabado'] . ' 23:59:59"');
         
        $registro_d_tr1  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr1_r  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR1-R" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr3  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR3" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
        $registro_d_tr4  =DB::connection('mysql')->select('select count(*) as conteo from t_bitacora_terminales
        WHERE Servicio="TR4" and dia BETWEEN "' . $diasSemana['domingo'] . ' 00:00:00"  AND "' . $diasSemana['domingo'] . ' 23:59:59"');
    
        
        $registro_t_l = ($registro_l_tr4[0]->conteo * 22.5) +($registro_l_tr1[0]->conteo * 33.6) 
        +($registro_l_tr1_r[0]->conteo * 33.6) + ($registro_l_tr3[0]->conteo * 33.6);

        $registro_t_m = ($registro_m_tr4[0]->conteo * 22.5) +($registro_m_tr1[0]->conteo * 33.6) 
        +($registro_m_tr1_r[0]->conteo * 33.6) + ($registro_m_tr3[0]->conteo * 33.6);
        
        $registro_t_mi = ($registro_mi_tr4[0]->conteo * 22.5) +($registro_mi_tr1[0]->conteo * 33.6) 
        +($registro_mi_tr1_r[0]->conteo * 33.6) + ($registro_mi_tr3[0]->conteo * 33.6);
        
        $registro_t_j = ($registro_j_tr4[0]->conteo * 22.5) +($registro_j_tr1[0]->conteo * 33.6) 
        +($registro_j_tr1_r[0]->conteo * 33.6) + ($registro_j_tr3[0]->conteo * 33.6);
        
        $registro_t_v = ($registro_v_tr4[0]->conteo * 22.5) +($registro_v_tr1[0]->conteo * 33.6) 
        +($registro_v_tr1_r[0]->conteo * 33.6) + ($registro_v_tr3[0]->conteo * 33.6);
        
        $registro_t_s = ($registro_s_tr4[0]->conteo * 22.5) +($registro_s_tr1[0]->conteo * 33.6) 
        +($registro_s_tr1_r[0]->conteo * 33.6) + ($registro_s_tr3[0]->conteo * 33.6);
        
        $registro_t_d = ($registro_d_tr4[0]->conteo * 22.5) +($registro_d_tr1[0]->conteo * 33.6) 
        +($registro_d_tr1_r[0]->conteo * 33.6) + ($registro_d_tr3[0]->conteo * 33.6);

        $tr1_ciclos_lv;
        $tr1_r_ciclos_lv;
        $tr3_ciclos_lv;
        $tr4_ciclos_lv;

        $tr1_ciclos_s ;
        $tr1_r_ciclos_s ;
        $tr3_ciclos_s ;
        $tr4_ciclos_s ;

        $tr1_ciclos_d;
        $tr1_r_ciclos_d;
        $tr3_ciclos_d;
        $tr4_ciclos_d;

        $total_ciclos;

        $fecha_busqueda =now()->format('Y-m-d') ;
    
            $tr1_ciclos_lv = DB::connection('mysql')->select('
            SELECT count(*) as conteo from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Lunes a Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos_lv = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Lunes a Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos_lv = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Lunes a Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos_lv = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Lunes a Viernes" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Lunes a Viernes" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
       
            $tr1_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr3_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos_s = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Sábado" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Sábado" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
       
            $tr1_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr1_r_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR1-R" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR1-R" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');;
            $tr3_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR3" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR3" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
            $tr4_ciclos_d = DB::connection('mysql')->select('
            SELECT count(*) as conteo  from t_jornada_completa_operacion_2 where dia_servicio="Domingo" and servicio="TR4" and id_jornada_pk in
            (select id_jornada_fk from t_jornada_conductores where servicio="TR4" and estatus="Enrolados" AND dia_servicio="Domingo" AND "'.$fecha_busqueda.'" BETWEEN dia_inicio and dia_fin )');
       
    
        $total_km_tr1_l = ($tr1_ciclos_lv[0]->conteo * 33.6) + ($tr1_r_ciclos_lv[0]->conteo * 33.6) + ($tr3_ciclos_lv[0]->conteo * 33.6) + ($tr4_ciclos_lv[0]->conteo * 22.5) ;
        $total_km_tr1_s = ($tr1_ciclos_s[0]->conteo * 33.6) + ($tr1_r_ciclos_s[0]->conteo * 33.6) + ($tr3_ciclos_s[0]->conteo * 33.6) + ($tr4_ciclos_s[0]->conteo * 22.5) ;
        $total_km_tr1_d = ($tr1_ciclos_d[0]->conteo * 33.6) + ($tr1_r_ciclos_d[0]->conteo * 33.6) + ($tr3_ciclos_d[0]->conteo * 33.6) + ($tr4_ciclos_d[0]->conteo * 22.5) ;
       // dd($total_km_tr1_l);
        $total_ciclos_lv = ($tr1_ciclos_lv[0]->conteo + $tr1_r_ciclos_lv[0]->conteo + $tr3_ciclos_lv[0]->conteo + $tr4_ciclos_lv[0]->conteo)*1 ; 
        $total_ciclos_s = $tr1_ciclos_s[0]->conteo + $tr1_r_ciclos_s[0]->conteo + $tr3_ciclos_s[0]->conteo + $tr4_ciclos_s[0]->conteo ; 
        $total_ciclos_d = $tr1_ciclos_d[0]->conteo + $tr1_r_ciclos_d[0]->conteo + $tr3_ciclos_d[0]->conteo + $tr4_ciclos_d[0]->conteo ; 

        $consulta_l = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['lunes'] . ' 00:00:00" AND "' .  $diasSemana['lunes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_m = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['martes'] . ' 00:00:00" AND "' .  $diasSemana['martes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_mi = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['miercoles'] . ' 00:00:00" AND "' .  $diasSemana['miercoles'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_j = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['jueves'] . ' 00:00:00" AND "' .  $diasSemana['jueves'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_v = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['viernes'] . ' 00:00:00" AND "' .  $diasSemana['viernes'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        
        $consulta_s = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['sabado'] . ' 00:00:00" AND "' .  $diasSemana['sabado'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');
        $consulta_d = DB::connection('mysql')->select('
            SELECT 
                t1.credencial, u.name AS conductor,
                t1.Servicio, t1.ciclo, t1.dia,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 1 THEN t1.terminal END), "Sin terminal") AS salida_1_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 2 THEN t1.terminal END), "Sin terminal") AS salida_2_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 3 THEN t1.terminal END), "Sin terminal") AS salida_3_ter,
                COALESCE(MAX(CASE WHEN t1.salida_entrada = 4 THEN t1.terminal END), "Sin terminal") AS salida_4_ter
            FROM  t_bitacora_terminales t1
            INNER JOIN   users as u ON u.id = t1.credencial 
            left  JOIN  users as u2 ON u2.id = t1.credencial_apoyo 
            INNER JOIN   c_terminal ON c_terminal.id_terminal = t1.terminal
            WHERE   t1.dia BETWEEN "' .  $diasSemana['domingo'] . ' 00:00:00" AND "' .  $diasSemana['domingo'] . ' 23:59:59"
            GROUP BY  t1.credencial,t1.ciclo,t1.Servicio,t1.dia,u.name
            ORDER BY  t1.credencial, t1.ciclo,t1.dia;
        ');

        $Ojo_De_Agua_1 = 0; 
        $Esmeralda_1 = 1.47; 
        $Cuauhtemoc_Norte_1 = 2; 
        $Cuauhtemoc_Sur_1 = 3.05; 
        $Hidalgo_1 = 3.58; 
        $Insurgentes_1 = 4.39; 
        $Central_De_Abastos_1 = 5.3; 
        $e_19_De_Septiembre_1 = 6.62; 
        $Palomas_1 = 7.6; 
        $Jardines_De_Morelos_1 = 8; 
        $Aquiles_Serdan_1 = 8.26; 
        $Hospital_1 = 8.77; 
        $e_1ro_De_Mayo_1 = 9.6; 
        $Las_Americas_1 = 10.55; 
        $Valle_De_Ecatepec_1 = 11.64; 
        $Vocacional_3_1 = 12.4; 
        $Adolfo_Lopez_Mateos_1 = 12.5; 
        $Zodiaco_1 = 13; 
        $Alfredo_Torres_1 = 13.58; 
        $Unitec_1 = 14.02; 
        $Estacion_Industrial_1 = 14.5; 
        $Josefa_Ortiz_De_Dominguez_1 = 15; 
        $Quinto_Sol_1 = 15.83; 
        $Ciudad_Azteca_1 = 16.5; 

        $Ojo_De_Agua_2 = 17.1; 
        $Esmeralda_2 = 15; 
        $Cuauhtemoc_Norte_2 = 14.5; 
        $Cuauhtemoc_Sur_2 = 13.47; 
        $Hidalgo_2 = 12.9; 
        $Insurgentes_2 = 12.04; 
        $Central_De_Abastos_2 = 11.3; 
        $e_19_De_Septiembre_2 = 9.8; 
        $Palomas_2 = 9.39; 
        $Jardines_De_Morelos_2 = 8.45; 
        $Aquiles_Serdan_2 = 8.18; 
        $Hospital_2 = 7.66; 
        $e_1ro_De_Mayo_2 = 6.73; 
        $Las_Americas_2 = 5.88; 
        $Valle_De_Ecatepec_2 = 4.8; 
        $Vocacional_3_2 = 4.31; 
        $Adolfo_Lopez_Mateos_2 = 3.93; 
        $Zodiaco_2 = 3.45; 
        $Alfredo_Torres_2 = 2.86; 
        $Unitec_2 = 2.34; 
        $Estacion_Industrial_2 = 1.86; 
        $Josefa_Ortiz_De_Dominguez_2 = 1.41; 
        $Quinto_Sol_2 = 0.6; 
        $Ciudad_Azteca_2 = 0; 

   // dd($consulta_l);
    $salida_1=0;
    $salida_2=0;
    $salida_3=0;
    $salida_4=0;
    $km_1_l;
    $km_2_l;
    $km_t_l=0;

    $km_1_m;
    $km_2_m;
    $km_t_m=0;

    $km_1_mi;
    $km_2_mi;
    $km_t_mi=0;

    $km_1_j;
    $km_2_j;
    $km_t_j=0;

    $km_1_v;
    $km_2_v;
    $km_t_v=0;

    $km_1_s;
    $km_2_s;
    $km_t_s=0;

    $km_1_d;
    $km_2_d;
    $km_t_d=0;

    for($i = 0 ;  count($consulta_l) > $i ; $i++ )
    {
        $km_1_l= 0;
        $km_2_l= 0;
        if( $consulta_l[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_l[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_l[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_l[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_l[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_l[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_l[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_l[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_l[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_l[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_l[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_l[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_l[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_l[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_l[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_l[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_l[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_l[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_l[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_l[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_l[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_l[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_l[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_l[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_l[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_l[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_l[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_l[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_l[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_l[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_l[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_l[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_l[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_l[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_l[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_l[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_l[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_l[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_l[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_l[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_l[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_l[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_l[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_l[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_l[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_l[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_l[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_l[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_l[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_l = $llegada_2 - $salida_1;
        }
        if( $consulta_l[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_l[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_l[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_l[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_l[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_l[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_l[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_l[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_l[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_l[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_l[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_l[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_l[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_l[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_l[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_l[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_l[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_l[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_l[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_l[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_l[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_l[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_l[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_l[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_l[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_l[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_l[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_l[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_l[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_l[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_l[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_l[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_l[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_l[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_l[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_l[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_l[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_l[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_l[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_l[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_l[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_l[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_l[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_l[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_l[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_l[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_l[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_l[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_l[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_l = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_l = $km_t_l + $km_1_l + $km_2_l;
    }

    for($i = 0 ;  count($consulta_m) > $i ; $i++ )
    {
        $km_1_m= 0;
        $km_2_m= 0;
        if($consulta_m[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_m[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_m[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_m[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_m[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_m[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_m[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_m[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_m[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_m[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_m[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_m[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_m[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_m[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_m[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_m[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_m[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_m[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_m[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_m[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_m[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_m[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_m[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_m[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_m[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_m[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_m[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_m[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_m[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_m[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_m[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_m[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_m[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_m[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_m[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_m[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_m[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_m[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_m[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_m[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_m[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_m[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_m[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_m[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_m[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_m[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_m[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_m[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_m[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_m = $llegada_2 - $salida_1;
        }
        if($consulta_m[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_m[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_m[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_m[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_m[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_m[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_m[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_m[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_m[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_m[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_m[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_m[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_m[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_m[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_m[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_m[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_m[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_m[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_m[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_m[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_m[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_m[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_m[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_m[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_m[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_m[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_m[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_m[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_m[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_m[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_m[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_m[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_m[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_m[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_m[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_m[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_m[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_m[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_m[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_m[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_m[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_m[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_m[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_m[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_m[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_m[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_m[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_m[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_m[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_m = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_m = $km_t_m + $km_1_m + $km_2_m;
    }
    for($i = 0 ;  count($consulta_mi) > $i ; $i++ )
    {
        $km_1_mi= 0;
        $km_2_mi= 0;
        if($consulta_mi[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_mi[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_mi[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_mi[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_mi[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_mi[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_mi[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_mi[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_mi[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_mi[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_mi[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_mi[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_mi[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_mi[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_mi[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_mi[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_mi[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_mi[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_mi[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_mi[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_mi[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_mi[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_mi[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_mi[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_mi[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_mi[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_mi[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_mi[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_mi[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_mi[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_mi[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_mi[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_mi[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_mi[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_mi[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_mi[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_mi[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_mi[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_mi[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_mi[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_mi[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_mi[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_mi[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_mi[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_mi[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_mi[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_mi[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_mi[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_mi[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_mi = $llegada_2 - $salida_1;
        }
        if( $consulta_mi[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_mi[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_mi[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_mi[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_mi[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_mi[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_mi[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_mi[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_mi[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_mi[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_mi[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_mi[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_mi[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_mi[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_mi[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_mi[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_mi[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_mi[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_mi[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_mi[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_mi[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_mi[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_mi[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_mi[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_mi[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_mi[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_mi[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_mi[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_mi[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_mi[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_mi[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_mi[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_mi[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_mi[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_mi[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_mi[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_mi[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_mi[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_mi[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_mi[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_mi[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_mi[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_mi[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_mi[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_mi[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_mi[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_mi[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_mi[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_mi[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_mi = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_mi = $km_t_mi + $km_1_mi + $km_2_mi;
    }


    for($i = 0 ;  count($consulta_j) > $i ; $i++ )
    {
        $km_1_j= 0;
        $km_2_j= 0;
        if( $consulta_j[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_j[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_j[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_j[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_j[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_j[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_j[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_j[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_j[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_j[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_j[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_j[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_j[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_j[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_j[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_j[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_j[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_j[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_j[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_j[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_j[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_j[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_j[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_j[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_j[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_j[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_j[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_j[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_j[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_j[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_j[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_j[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_j[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_j[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_j[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_j[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_j[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_j[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_j[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_j[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_j[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_j[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_j[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_j[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_j[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_j[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_j[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_j[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_j[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_j = $llegada_2 - $salida_1;
        }
        if( $consulta_j[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_j[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_j[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_j[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_j[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_j[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_j[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_j[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_j[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_j[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_j[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_j[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_j[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_j[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_j[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_j[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_j[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_j[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_j[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_j[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_j[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_j[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_j[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_j[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_j[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_j[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_j[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_j[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_j[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_j[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_j[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_j[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_j[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_j[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_j[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_j[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_j[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_j[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_j[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_j[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_j[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_j[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_j[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_j[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_j[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_j[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_j[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_j[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_j[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_j = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_j = $km_t_j + $km_1_j + $km_2_j;
    }


    for($i = 0 ;  count($consulta_v) > $i ; $i++ )
    {
        $km_1_v= 0;
        $km_2_v= 0;
        if( $consulta_v[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_v[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_v[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_v[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_v[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_v[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_v[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_v[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_v[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_v[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_v[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_v[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_v[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_v[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_v[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_v[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_v[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_v[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_v[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_v[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_v[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_v[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_v[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_v[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_v[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_v[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_v[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_v[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_v[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_v[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_v[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_v[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_v[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_v[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_v[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_v[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_v[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_v[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_v[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_v[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_v[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_v[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_v[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_v[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_v[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_v[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_v[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_v[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_v[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_v = $llegada_2 - $salida_1;
        }
        if( $consulta_v[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_v[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_v[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_v[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_v[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_v[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_v[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_v[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_v[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_v[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_v[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_v[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_v[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_v[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_v[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_v[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_v[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_v[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_v[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_v[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_v[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_v[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_v[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_v[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_v[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_v[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_v[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_v[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_v[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_v[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_v[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_v[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_v[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_v[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_v[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_v[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_v[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_v[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_v[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_v[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_v[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_v[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_v[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_v[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_v[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_v[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_v[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_v[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_v[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_v = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_v = $km_t_v + $km_1_v + $km_2_v;
    }


    for($i = 0 ;  count($consulta_s) > $i ; $i++ )
    {
        $km_1_s= 0;
        $km_2_s= 0;
        if(  $consulta_s[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_s[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_s[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_s[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_s[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_s[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_s[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_s[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_s[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_s[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_s[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_s[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_s[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_s[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_s[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_s[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_s[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_s[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_s[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_s[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_s[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_s[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_s[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_s[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_s[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_s[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_s[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_s[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_s[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_s[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_s[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_s[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_s[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_s[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_s[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_s[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_s[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_s[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_s[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_s[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_s[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_s[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_s[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_s[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_s[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_s[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_s[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_s[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_s[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_s = $llegada_2 - $salida_1;
        }
        if( $consulta_s[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_s[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_s[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_s[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_s[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_s[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_s[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_s[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_s[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_s[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_s[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_s[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_s[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_s[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_s[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_s[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_s[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_s[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_s[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_s[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_s[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_s[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_s[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_s[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_s[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_s[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_s[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_s[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_s[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_s[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_s[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_s[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_s[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_s[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_s[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_s[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_s[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_s[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_s[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_s[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_s[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_s[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_s[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_s[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_s[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_s[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_s[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_s[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_s[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_s = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_s = $km_t_s + $km_1_s + $km_2_s;
    }

    for($i = 0 ;  count($consulta_d) > $i ; $i++ )
    {
        $km_1_d= 0;
        $km_2_d= 0;
        if( $consulta_d[$i]->salida_2_ter != 'Sin terminal')
        {
            
            if($consulta_d[$i]->salida_1_ter==1)  {  $salida_1 = $Ojo_De_Agua_1; }
            else if($consulta_d[$i]->salida_1_ter==2)  { $salida_1 = $Central_De_Abastos_1; }
            else if($consulta_d[$i]->salida_1_ter==3)  { $salida_1 = $Ciudad_Azteca_1 ;}
            else if($consulta_d[$i]->salida_1_ter==4)  { $salida_1 = $Esmeralda_1; }
            else if($consulta_d[$i]->salida_1_ter==5)  { $salida_1 = $Cuauhtemoc_Norte_1; }
            else if($consulta_d[$i]->salida_1_ter==6)  { $salida_1 = $Cuauhtemoc_Sur_1; }
            else if($consulta_d[$i]->salida_1_ter==7)  { $salida_1 = $Hidalgo_1; }
            else if($consulta_d[$i]->salida_1_ter==8)  { $salida_1 = $Insurgentes_1; }
            else if($consulta_d[$i]->salida_1_ter==9)  { $salida_1 = $e_19_De_Septiembre_1; }
            else if($consulta_d[$i]->salida_1_ter==10)  { $salida_1 = $Palomas_1; }
            else if($consulta_d[$i]->salida_1_ter==11)  { $salida_1 = $Jardines_De_Morelos_1; }
            else if($consulta_d[$i]->salida_1_ter==12)  { $salida_1 = $Aquiles_Serdan_1; }
            else if($consulta_d[$i]->salida_1_ter==13)  { $salida_1 = $Hospital_1; }
            else if($consulta_d[$i]->salida_1_ter==14)  { $salida_1 = $e_1ro_De_Mayo_1; }
            else if($consulta_d[$i]->salida_1_ter==15)  { $salida_1 = $Las_Americas_1; }
            else if($consulta_d[$i]->salida_1_ter==16)  { $salida_1 = $Valle_De_Ecatepec_1; }
            else if($consulta_d[$i]->salida_1_ter==17)  { $salida_1 = $Vocacional_3_1; }
            else if($consulta_d[$i]->salida_1_ter==18)  { $salida_1 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_d[$i]->salida_1_ter==19)  { $salida_1 = $Zodiaco_1; }
            else if($consulta_d[$i]->salida_1_ter==20)  { $salida_1 = $Alfredo_Torres_1; }
            else if($consulta_d[$i]->salida_1_ter==21)  { $salida_1 = $Unitec_1 ; }
            else if($consulta_d[$i]->salida_1_ter==22)  { $salida_1 = $Estacion_Industrial_1; }
            else if($consulta_d[$i]->salida_1_ter==23)  { $salida_1 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_d[$i]->salida_1_ter==24)  { $salida_1 = $Quinto_Sol_1; }

            if($consulta_d[$i]->salida_2_ter==1)  { $llegada_2 = $Ojo_De_Agua_1; }
            else if($consulta_d[$i]->salida_2_ter==2)  { $llegada_2 = $Central_De_Abastos_1; }
            else if($consulta_d[$i]->salida_2_ter==3)  { $llegada_2 = $Ciudad_Azteca_1;  }
            else if($consulta_d[$i]->salida_2_ter==4)  { $llegada_2 = $Esmeralda_1; }
            else if($consulta_d[$i]->salida_2_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_1; }
            else if($consulta_d[$i]->salida_2_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_1; }
            else if($consulta_d[$i]->salida_2_ter==7)  { $llegada_2 = $Hidalgo_1; }
            else if($consulta_d[$i]->salida_2_ter==8)  { $llegada_2 = $Insurgentes_1; }
            else if($consulta_d[$i]->salida_2_ter==9)  { $llegada_2 = $e_19_De_Septiembre_1; }
            else if($consulta_d[$i]->salida_2_ter==10)  { $llegada_2 = $Palomas_1; }
            else if($consulta_d[$i]->salida_2_ter==11)  { $llegada_2 = $Jardines_De_Morelos_1; }
            else if($consulta_d[$i]->salida_2_ter==12)  { $llegada_2 = $Aquiles_Serdan_1; }
            else if($consulta_d[$i]->salida_2_ter==13)  { $llegada_2 = $Hospital_1; }
            else if($consulta_d[$i]->salida_2_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_1; }
            else if($consulta_d[$i]->salida_2_ter==15)  { $llegada_2 = $Las_Americas_1; }
            else if($consulta_d[$i]->salida_2_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_1; }
            else if($consulta_d[$i]->salida_2_ter==17)  { $llegada_2 = $Vocacional_3_1; }
            else if($consulta_d[$i]->salida_2_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_1; }
            else if($consulta_d[$i]->salida_2_ter==19)  { $llegada_2 = $Zodiaco_1; }
            else if($consulta_d[$i]->salida_2_ter==20)  { $llegada_2 = $Alfredo_Torres_1; }
            else if($consulta_d[$i]->salida_2_ter==21)  { $llegada_2 = $Unitec_1 ; }
            else if($consulta_d[$i]->salida_2_ter==22)  { $llegada_2 = $Estacion_Industrial_1; }
            else if($consulta_d[$i]->salida_2_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_1; }
            else if($consulta_d[$i]->salida_2_ter==24)  { $llegada_2 = $Quinto_Sol_1; }

            $km_1_d = $llegada_2 - $salida_1;
        }
        if( $consulta_d[$i]->salida_4_ter != 'Sin terminal')
        {
                if($consulta_d[$i]->salida_3_ter==1)  { $salida_2 = $Ojo_De_Agua_2;}
                else if($consulta_d[$i]->salida_3_ter==2)  { $salida_2 = $Central_De_Abastos_2;}
                else if($consulta_d[$i]->salida_3_ter==3)  { $salida_2 = $Ciudad_Azteca_2 ;}
                else if($consulta_d[$i]->salida_3_ter==4)  { $salida_2 = $Esmeralda_2;}
                else if($consulta_d[$i]->salida_3_ter==5)  { $salida_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_d[$i]->salida_3_ter==6)  { $salida_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_d[$i]->salida_3_ter==7)  { $salida_2 = $Hidalgo_2;}
                else if($consulta_d[$i]->salida_3_ter==8)  { $salida_2 = $Insurgentes_2;}
                else if($consulta_d[$i]->salida_3_ter==9)  { $salida_2 = $e_19_De_Septiembre_2;}
                else if($consulta_d[$i]->salida_3_ter==10)  { $salida_2 = $Palomas_2;}
                else if($consulta_d[$i]->salida_3_ter==11)  { $salida_2 = $Jardines_De_Morelos_2;}
                else if($consulta_d[$i]->salida_3_ter==12)  { $salida_2 = $Aquiles_Serdan_2;}
                else if($consulta_d[$i]->salida_3_ter==13)  { $salida_2 = $Hospital_2;}
                else if($consulta_d[$i]->salida_3_ter==14)  { $salida_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_d[$i]->salida_3_ter==15)  { $salida_2 = $Las_Americas_2;}
                else if($consulta_d[$i]->salida_3_ter==16)  { $salida_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_d[$i]->salida_3_ter==17)  { $salida_2 = $Vocacional_3_2;}
                else if($consulta_d[$i]->salida_3_ter==18)  { $salida_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_d[$i]->salida_3_ter==19)  { $salida_2 = $Zodiaco_2;}
                else if($consulta_d[$i]->salida_3_ter==20)  { $salida_2 = $Alfredo_Torres_2;}
                else if($consulta_d[$i]->salida_3_ter==21)  { $salida_2 = $Unitec_2; }
                else if($consulta_d[$i]->salida_3_ter==22)  { $salida_2 = $Estacion_Industrial_2;}
                else if($consulta_d[$i]->salida_3_ter==23)  { $salida_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_d[$i]->salida_3_ter==24)  { $salida_2 = $Quinto_Sol_2;}


                if($consulta_d[$i]->salida_4_ter==1)  { $llegada_2 = $Ojo_De_Agua_2;}
                else if($consulta_d[$i]->salida_4_ter==2)  { $llegada_2 = $Central_De_Abastos_2;}
                else if($consulta_d[$i]->salida_4_ter==3)  { $llegada_2 = $Ciudad_Azteca_2; }
                else if($consulta_d[$i]->salida_4_ter==4)  { $llegada_2 = $Esmeralda_2;}
                else if($consulta_d[$i]->salida_4_ter==5)  { $llegada_2 = $Cuauhtemoc_Norte_2;}
                else if($consulta_d[$i]->salida_4_ter==6)  { $llegada_2 = $Cuauhtemoc_Sur_2;}
                else if($consulta_d[$i]->salida_4_ter==7)  { $llegada_2 = $Hidalgo_2;}
                else if($consulta_d[$i]->salida_4_ter==8)  { $llegada_2 = $Insurgentes_2;}
                else if($consulta_d[$i]->salida_4_ter==9)  { $llegada_2 = $e_19_De_Septiembre_2;}
                else if($consulta_d[$i]->salida_4_ter==10)  { $llegada_2 = $Palomas_2;}
                else if($consulta_d[$i]->salida_4_ter==11)  { $llegada_2 = $Jardines_De_Morelos_2;}
                else if($consulta_d[$i]->salida_4_ter==12)  { $llegada_2 = $Aquiles_Serdan_2;}
                else if($consulta_d[$i]->salida_4_ter==13)  { $llegada_2 = $Hospital_2;}
                else if($consulta_d[$i]->salida_4_ter==14)  { $llegada_2 = $e_1ro_De_Mayo_2;}
                else if($consulta_d[$i]->salida_4_ter==15)  { $llegada_2 = $Las_Americas_2;}
                else if($consulta_d[$i]->salida_4_ter==16)  { $llegada_2 = $Valle_De_Ecatepec_2;}
                else if($consulta_d[$i]->salida_4_ter==17)  { $llegada_2 = $Vocacional_3_2;}
                else if($consulta_d[$i]->salida_4_ter==18)  { $llegada_2 = $Adolfo_Lopez_Mateos_2;}
                else if($consulta_d[$i]->salida_4_ter==19)  { $llegada_2 = $Zodiaco_2;}
                else if($consulta_d[$i]->salida_4_ter==20)  { $llegada_2 = $Alfredo_Torres_2;}
                else if($consulta_d[$i]->salida_4_ter==21)  { $llegada_2 = $Unitec_2 ;}
                else if($consulta_d[$i]->salida_4_ter==22)  { $llegada_2 = $Estacion_Industrial_2;}
                else if($consulta_d[$i]->salida_4_ter==23)  { $llegada_2 = $Josefa_Ortiz_De_Dominguez_2;}
                else if($consulta_d[$i]->salida_4_ter==24)  { $llegada_2 = $Quinto_Sol_2;}
                $km_2_d = $llegada_2 - $salida_2;
                
            
        }
        
        $km_t_d = $km_t_d + $km_1_d + $km_2_d;
    }
    //dd($request->all());
    $km_t_l_no = $total_km_tr1_l - $km_t_l;
    $km_t_m_no = $total_km_tr1_l - $km_t_m;
    $km_t_mi_no = $total_km_tr1_l - $km_t_mi;
    $km_t_j_no = $total_km_tr1_l - $km_t_j;
    $km_t_v_no = $total_km_tr1_l - $km_t_v;
    $km_t_s_no = $total_km_tr1_s - $km_t_s;
    $km_t_d_no = $total_km_tr1_d - $km_t_d;
    $imagenBase64 = $request->input('imagenBase64');
    $imagenBase642 = $request->input('imagenBase642');
    $semana = $request->input('semana');
    // Extraer las fechas inicial y final
    preg_match_all("/'([^']+)'/", $semana, $matches);
    $fecha_inicio = $matches[1][0];
    $fecha_fin = $matches[1][1];

    // Crear objetos DateTime para las dos fechas
    $inicio = new DateTime($fecha_inicio);
    $fin = new DateTime($fecha_fin);

    // Array de días y meses en español
    $dias_semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    // Formatear las fechas en el formato deseado
    $inicio_formateado = $dias_semana[$inicio->format('w')] . ', ' . $inicio->format('d') . ' de ' . $meses[$inicio->format('n') - 1] . ' del ' . $inicio->format('Y');
    $fin_formateado = $dias_semana[$fin->format('w')] . ', ' . $fin->format('d') . ' de ' . $meses[$fin->format('n') - 1] . ' del ' . $fin->format('Y');

    // Generar la cadena final
    $cadena_resultado = $inicio_formateado . ' al ' . $fin_formateado;
//dd($request->all());
    $html = view('Transmasivo.Operaciones.pdf_Reporte_de_jornadas',  compact('imagenBase64','imagenBase642','km_t_l_no','km_t_m_no','km_t_mi_no','km_t_j_no',
    'km_t_v_no','km_t_s_no','km_t_d_no','cadena_resultado',
    'km_t_l','km_t_m','km_t_mi','km_t_j','km_t_v','km_t_s','km_t_d','registro_l','registro_m','registro_mi','registro_j','registro_v'
    ,'total_km_tr1_l','total_km_tr1_s','total_km_tr1_d'
    ,'registro_t_l','registro_t_m','registro_t_mi','registro_t_j','registro_t_v','registro_t_s','registro_t_d'
    ,'registro_s','registro_d','total_ciclos_lv','total_ciclos_s','total_ciclos_d'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('Carta', 'landscape'); 
        $dompdf->render();
        return $dompdf->stream('Reporte de '.$cadena_resultado.'.pdf');

    return view('Transmasivo.Operaciones.Reporte_de_jornadas',
    compact('km_t_l_no','km_t_m_no','km_t_mi_no','km_t_j_no','km_t_v_no','km_t_s_no','km_t_d_no',
    'km_t_l','km_t_m','km_t_mi','km_t_j','km_t_v','km_t_s','km_t_d','registro_l','registro_m','registro_mi','registro_j','registro_v'
    ,'total_km_tr1_l','total_km_tr1_s','total_km_tr1_d'
    ,'registro_t_l','registro_t_m','registro_t_mi','registro_t_j','registro_t_v','registro_t_s','registro_t_d'
    ,'registro_s','registro_d','total_ciclos_lv','total_ciclos_s','total_ciclos_d'));

    }
}

public function Registrar_conductor()
{
    return view('Transmasivo.Operaciones.Registrar_conductor');
}
public function postRegistrar_conductor(Request $request)
{
    $id_empleado = $request->input('id_empleado');
    $Nombre = $request->input('Nombre');
    $Apellido_Paterno = $request->input('Apellido_Paterno');
    $Apellido_Materno = $request->input('Apellido_Materno');
    $nombreCompleto = $Nombre .' ' .$Apellido_Paterno .' ' .$Apellido_Materno ; 
    $correo = 'conductor_'.$id_empleado.'@transmasivo.mx';
    User::factory()->create([
        'id' => $id_empleado,
        'name' => $nombreCompleto,
        'password' => bcrypt('123456'),
        'email' => $correo,
        'tipo_usuario' => 'Conductor',
        
    ]);
    
    
    
    return redirect()->route('Registrar_conductor')->with('mensaje', 'Se registro correctamente!!')->with('color', 'success');
}



}
