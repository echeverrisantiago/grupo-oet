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
        Schema::create('sys_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate', 10)->unique()->comment('Placa del vehículo');
            $table->string('color', 20)->comment('Color del vehículo');
            $table->string('brand', 45)->comment('Marca del vehículo');
            $table->tinyInteger('type')->comment('Tipo de vehículo');
            $table->unsignedBigInteger('owner_id')->comment('Propietario del vehículo');
            $table->unsignedBigInteger('driver_id')->comment('Conductor del vehículo');

            // Indices
            $table->index('owner_id');
            $table->index('driver_id');

            // Foraneas
            $table->foreign('owner_id')->references('id')->on('sys_workers')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('sys_workers')->onDelete('cascade');

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
        Schema::dropIfExists('sys_vehicles');
    }
};
