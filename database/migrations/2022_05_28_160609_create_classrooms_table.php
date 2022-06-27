<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id(); //classroom_id
            $table->string('classroom_name'); //Nombre del aula
            $table->string('location'); //Ubicación
            $table->integer('capacity'); //Capacidad
            $table->enum('type', ['Laboratorio', 'Aula común']); //Tipo de aula
            $table->enum('building', ['Informática', 'Economía', 'Humanidades', 'Aulas comunes', 'Biblioteca']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
};
