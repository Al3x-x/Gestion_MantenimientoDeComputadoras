<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'informes';
    protected $fillable = ['Institucion', 'Estado', 'Informe', 'Observacion'];
}
