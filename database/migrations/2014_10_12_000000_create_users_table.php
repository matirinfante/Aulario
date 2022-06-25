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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //user_id
            $table->string('name');  //Nombre
            $table->string('surname');  //Apellido
            $table->integer('dni')->unique(); //DNI
            $table->string('email')->unique(); //Email
            $table->string('password'); //Contraseña
            $table->uuid('user_uuid');
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
        Schema::dropIfExists('users');
    }
};
