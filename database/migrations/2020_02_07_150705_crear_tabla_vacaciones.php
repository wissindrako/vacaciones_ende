<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaVacaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('persona_id');
            $table->foreign('persona_id', 'fk_vacaciones_persona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('restrict');
            $table->date('inicio');
            $table->date('fin');
            $table->unsignedInteger('dias_tomados');
            $table->unsignedInteger('tiempo_id');
            $table->foreign('tiempo_id', 'fk_vacaciones_tiempo')->references('id')->on('tiempo')->onDelete('cascade')->onUpdate('restrict');
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
        Schema::dropIfExists('vacaciones');
    }
}
