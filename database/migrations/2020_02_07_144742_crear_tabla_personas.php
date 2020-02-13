<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('paterno', 50)->nullable();
            $table->string('materno', 50)->nullable();
            $table->string('codigo', 15)->unique();
            $table->string('cargo', 60)->nullable();
            $table->string('dpto_seccion', 60)->nullable();
            $table->double('haber_basico', 15, 2)->default(0.0);
            $table->date('fecha_ingreso');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
