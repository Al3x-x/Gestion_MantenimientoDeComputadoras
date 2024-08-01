<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;
    protected $table = 'diagnosticos';
    protected $fillable = ['Institucion', 'Num_Lab', 'Tipos_Equipos', 'Num_Maquinas', 'Categoria', 'Solucion_General', 'Observaciones'];
}
