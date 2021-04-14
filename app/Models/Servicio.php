<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'empleado_id', 'cliente_id', 'observaciones', 'fecha_entrega'
    ];
}
