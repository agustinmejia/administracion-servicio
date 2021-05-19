<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->nullable()->constrained('servicios');
            $table->foreignId('tipo_equipo_id')->nullable()->constrained('tipo_equipos');
            $table->string('equipo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('problema')->nullable();
            $table->string('diagnostico')->nullable();
            $table->string('solucion')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
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
        Schema::dropIfExists('servicios_detalles');
    }
}
