<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cliente_id', 'observaciones', 'proforma'];

    public function empleado(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalle(){
        return $this->hasMany(VentasDetalle::class);
    }
}
