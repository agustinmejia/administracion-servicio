<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('categoria')->nullable();
            $table->string('slug')->unique();
            $table->string('descripcion')->nullable();
            $table->decimal('precio', 10, 2)->default(0)->nullable();
            $table->decimal('precio_antiguo', 10, 2)->default(0)->nullable();
            $table->text('detalle')->nullable();
            $table->text('detalle_extendido')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
