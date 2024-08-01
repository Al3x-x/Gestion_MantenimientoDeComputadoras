<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institucion');
            $table->foreign('institucion')->references('id')->on('solicituds')->onDelete('cascade');
            $table->string('num_lab');
            $table->string('tipos_equipos');
            $table->string('num_maquinas');
            $table->string('categoria');
            $table->string('solucion_general');
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
