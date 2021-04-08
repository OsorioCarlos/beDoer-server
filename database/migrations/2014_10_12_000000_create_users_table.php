<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nombre del usuario');
            $table->string('email')->comment('Correo electrónico de usuario')->unique();
            $table->timestamp('email_verified_at')->comment('Fecha de verificación de correo')->nullable();
            $table->string('password')->comment('Contraseña de usuario');
            $table->string('api_token')->comment('Token de usuario')->nullable()->unique();
            $table->boolean('deleted')->comment('Eliminado lógico')->default(false);
            $table->rememberToken()->comment('Acompaña al toquen de usuario');
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
}
