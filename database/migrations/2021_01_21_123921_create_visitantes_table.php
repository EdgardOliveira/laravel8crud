<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('navegador');
            $table->ipAddress('ip');
            $table->string('pais');
            $table->string('uf');
            $table->string('localidade');
            $table->string('bairro');
            $table->double('latitude');
            $table->double('longitude');
            $table->foreignId('visita_id')->constrained('visitas');
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
        Schema::dropIfExists('visitantes');
    }
}
