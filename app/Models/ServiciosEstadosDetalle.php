<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosEstadosDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id', 'empleado_id', 'observaciones'
    ];
}
