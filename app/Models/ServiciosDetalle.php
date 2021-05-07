<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id', 'tipo_equipo_id', 'equipo', 'descripcion', 'problema', 'diagnostico', 'solucion'
    ];

    public function tipo(){
        return $this->belongsTo(TipoEquipo::class, 'tipo_equipo_id');
    }
}
