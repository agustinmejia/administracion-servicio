<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
    use HasFactory;

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'costo', 'detalle'];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
