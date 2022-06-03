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
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('assignment_id')->constrained();
            $table->integer('estimated_people');
            $table->enum('classroom_type', ['Laboratorio', 'Aula común', 'Híbrido']);
            $table->time('start_time');
            $table->time('finish_time');
            $table->string('days')->nullable();
            $table->string('message')->nullable();
            $table->enum('status', ['unsolved', 'rejected', 'solved'])->default('unsolved');
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
        Schema::dropIfExists('petitions');
    }
};
