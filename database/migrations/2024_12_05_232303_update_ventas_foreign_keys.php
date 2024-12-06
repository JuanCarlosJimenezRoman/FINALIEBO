<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            // Eliminar la clave foránea existente (si aplica)
            $table->dropForeign(['id_cliente']);

            // Crear una nueva clave foránea apuntando a la tabla `users`
            $table->foreign('id_cliente')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign(['id_cliente']); // Eliminar la clave nueva

            // Opcional: Volver a apuntar a la tabla `clientes`
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
        });
    }
};
