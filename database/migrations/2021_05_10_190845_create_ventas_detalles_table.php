<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->nullable()->constrained('ventas');
            $table->foreignId('producto_id')->nullable()->constrained('productos');
            $table->integer('cantidad')->nullable();
            $table->decimal('costo', 8, 2)->nullable();
            $table->string('detalle')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_detalles');
    }
}
