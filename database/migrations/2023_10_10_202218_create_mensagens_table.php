<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id('id_mensagem');
            $table->foreignId('id_conversas')->constrained('conversas','id_conversas');
            $table->foreignId('id_usuario_enviante')->constrained('usuarios','id_usuario');
            $table->string('texto_mensagem');
            $table->date('data_envio');
            $table->time('hora_envio');
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
        Schema::dropIfExists('mensagens');
    }
}
