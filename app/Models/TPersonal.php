<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPersonal extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 't_personal';
    protected $primaryKey = 'id_personal'; // Si la tabla tiene una clave primaria distinta a 'id', ajústala aquí

    protected $fillable = [
        'Nombre',
        'Edad',
        'Fecha_nacimiento',
        'Sexo',
        'Nacionalidad',
        'Estado_civil',
        'Calle',
        'Numero',
        'Colonia',
        'Alcaldia_municipio',
        'Estado',
        'Codigo_postal',
        'RFC',
        'NSS',
        'CURP',
        'Correo',
        'Puesto',
        'Salario_diario',
        'Fecha_contrato',
        'Fecha_real',
        'Estatus',
        'id_operador',
        'Fecha_contrato_date',
        
    ];

    // Si no se van a utilizar los campos created_at y updated_at, ajusta las siguientes propiedades:
    public $timestamps = false;
}
