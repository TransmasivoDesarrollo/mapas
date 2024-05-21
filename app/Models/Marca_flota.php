<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca_flota extends Model
{
    protected $table = 'Marca_flota';
    protected $primaryKey = 'id_marca'; 

    protected $fillable = [
        'marca',
        'id_marca',
    ];

    public $timestamps = false;
}
