<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Título de una tarea');
            $table->string('description')->comment('Descripción de la tarea')->nullable();
            $table->dateTime('expiration_date')->comment('Fecha de expiración para una tarea')->nullable();
            $table->foreignId('state_id')->comment('Estado de una tarea (to do, doing, done)')->constrained('states');
            $table->morphs('taskable'); // Las tareas pueden pertenecer a un equipo o usuario
            $table->boolean('deleted')->comment('Eliminado lógico')->default(false);
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
        Schema::dropIfExists('tasks');
    }
}
