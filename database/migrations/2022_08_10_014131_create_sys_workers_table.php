<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_workers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('identification')->unique()->comment('Identificación del trabajador');
            $table->string('first_name', 45)->comment('Primer nombre del trabajador');
            $table->string('second_name', 45)->nullable()->comment('Segundo nombre del trabajador');
            $table->string('last_name', 45)->comment('Apellidos del trabajador');
            $table->string('address', 255)->comment('Dirección del trabajador');
            $table->integer('telephone')->comment('Teléfono del trabajador');
            $table->string('city', 45)->comment('Ciudad del trabajador');
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
        Schema::dropIfExists('sys_workers');
    }
};
