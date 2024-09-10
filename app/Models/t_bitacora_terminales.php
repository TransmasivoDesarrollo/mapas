<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_bitacora_terminales extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_bitacora_terminales';
    protected $primaryKey = 'id_bitacora_terminales'; // Si la tabla tiene una clave primaria distinta a 'id', ajústala aquí

    protected $fillable = [
        'terminal',
        'hora_llegada',
        'Servicio',
        'Jornada',
        'eco',
        'dia',
        'credencial',
        'kilometraje',
        'hora_salida',
        'comentario',
        'fecha_registro',
        'id_usuario',
    ];

    // Si no se van a utilizar los campos created_at y updated_at, ajusta las siguientes propiedades:
    public $timestamps = false;
}
