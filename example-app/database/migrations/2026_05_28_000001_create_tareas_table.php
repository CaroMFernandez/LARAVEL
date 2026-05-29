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
        if (!Schema::hasTable('tareas')) {
            Schema::create('tareas', function (Blueprint $table) {
                $table->bigIncrements('id_tarea');
                $table->string('nombre_tarea', 255);
                $table->text('descripcion')->nullable();
                $table->enum('estado', ['pendiente', 'en_progreso', 'completada'])->default('pendiente');
                $table->unsignedBigInteger('Sprints_id_sprint');
                $table->date('fecha_vencimiento')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
