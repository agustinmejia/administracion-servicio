<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'empleado_id', 'cliente_id', 'observaciones', 'fecha_entrega', 'costo', 'entregado', 'proforma'
    ];

    public function detalle(){
        return $this->hasMany(ServiciosDetalle::class);
    }

    public function estados_servicio(){
        return $this->hasMany(ServiciosEstadosDetalle::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
