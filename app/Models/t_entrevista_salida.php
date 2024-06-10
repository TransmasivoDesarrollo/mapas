<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_entrevista_salida extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_entrevista_salida';
    protected $primaryKey = 'id_entrevista_salida'; // Si la tabla tiene una clave primaria distinta a 'id', ajústala aquí

    protected $fillable = [
        'tiempo_laborado_meses',
        'horas_al_dia',
        'relacion_jefe',
        'reconocimiento_jefe',
        'reconocimiento_empresa',
        'toma_decisiones',
        'importante_labor',
        'sueldo_parecio',
        'crecimiento_laboral',
        'instrucciones_claras',
        'carga_trabajo',
        'reuniones_trabajo',
        'aspiraciones_empresa',
        'relaciones_personales_compañeros',
        'responsabilidades_asumir',
        'satisfecho_trabajo',
        'cansado_falta_energia',
        'entusiasmo_perdido',
        'perdida_apetito',
        'irritado',
        'faltas_al_mes',
        'cursos_funciionales',
        'baja_es',
        'baja_motivo',
        'volver_laborar',
        'observaciones',
        'fecha',
        'edad',
        'sexo',
        
        
    ];

    // Si no se van a utilizar los campos created_at y updated_at, ajusta las siguientes propiedades:
    public $timestamps = false;
}
