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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); //Usuario vinculado a la reserva
            $table->foreignId('classroom_id')->constrained(); //Aula vinculada
            $table->string('description'); //Descripcion de la reserva
            $table->enum('status', ['pending', 'in_progress', 'finished', 'cancelled']); //Estado de la reserva
            $table->foreignId('assignment_id')->nullable()->constrained(); //Materia vinculada si es horario fijo
            $table->enum('week_day', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'])->nullable(); //Dia de la semana (horario fijo)
            $table->foreignId('event_id')->nullable()->constrained(); //Evento vinculado si es una reserva temporal
            $table->date('booking_date'); //Fecha (reserva temporal)
            $table->time('start_time'); //Hora de inicio
            $table->time('finish_time'); //Hora de finalización
            $table->uuid('booking_uuid');
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
        Schema::dropIfExists('bookings');
    }
};
