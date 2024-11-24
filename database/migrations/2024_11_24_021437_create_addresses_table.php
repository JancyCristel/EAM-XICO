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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relación con la tabla users
            $table->string('calle'); // Calle
            $table->string('numero_casa'); // Número de casa
            $table->string('colonia'); // Colonia
            $table->string('estado'); // Estado
            $table->string('municipio'); // Municipio
            $table->string('codigo_postal'); // Código postal
            $table->string('nombre_recibe'); // Nombre de la persona que recibe
            $table->string('phone_number'); // Número de teléfono
            $table->string('referencias')->nullable(); // Referencias opcionales
            $table->string('entre_calles')->nullable(); // Entre calles opcional
            $table->boolean('is_default')->default(false); // Si es la dirección predeterminada
            $table->timestamps();

            // Clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
