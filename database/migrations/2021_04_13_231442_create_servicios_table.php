<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('empleado_id')->nullable()->constrained('empleados');
            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->text('observaciones')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->smallInteger('entregado')->nullable()->default(0);
            $table->text('proforma')->nullable();
            $table->string('imagenes')->nullable();
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
        Schema::dropIfExists('servicios');
    }
}
