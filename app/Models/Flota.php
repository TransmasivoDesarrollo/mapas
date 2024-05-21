<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flota extends Model
{
    protected $table = 'flota';
    protected $primaryKey = 'id_flota'; 

    protected $fillable = [
        'num_economico',
        'marca_flota',
        'km',
        'bares',
        'fecha_creacion',
        
    ];

    public $timestamps = false;
}
