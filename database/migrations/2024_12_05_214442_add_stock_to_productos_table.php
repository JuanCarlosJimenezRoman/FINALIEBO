<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('codigo')->unique()->after('id'); // Código único del producto
            $table->string('producto')->after('codigo'); // Nombre del producto
            $table->decimal('precio_compra', 8, 2)->after('producto'); // Precio de compra
            $table->decimal('precio_venta', 8, 2)->after('precio_compra'); // Precio de venta
            $table->string('foto')->nullable()->after('precio_venta'); // Ruta de la imagen (puede ser nulo)
            $table->unsignedBigInteger('id_categoria')->after('foto'); // Relación con la tabla categorías
            $table->integer('stock')->default(0)->after('id_categoria'); // Stock inicial, por defecto 0

            // Agregar clave foránea a la tabla 'categorias'
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropForeign(['id_categoria']); // Elimina la clave foránea
            $table->dropColumn(['codigo', 'producto', 'precio_compra', 'precio_venta', 'foto', 'id_categoria', 'stock']); // Elimina las columnas agregadas
        });
    }
};
