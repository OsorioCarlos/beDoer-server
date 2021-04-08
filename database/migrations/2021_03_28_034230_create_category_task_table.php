<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->comment('Una tarea pertenece a varias categorías')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('categories')->comment('Una categoría tiene varias tareas')
                ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('category_task');
    }
}
