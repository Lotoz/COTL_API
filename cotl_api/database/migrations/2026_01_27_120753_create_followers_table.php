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
        Schema::create('followers', function (Blueprint $table) {
            $table->id(); // ID (BigInt) - Tipo 1
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relación con el dueño
            $table->string('name');            // 1. Nombre (String) - Tipo 2
            $table->string('species');         // 2. Especie (String)
            $table->integer('level');          // 3. Nivel (Integer) - Tipo 3
            $table->integer('loyalty_points'); // 4. Puntos de lealtad (Integer)
            $table->boolean('is_elderly');     // 5. ¿Es anciano? (Boolean) - Tipo 4 (Ya llevamos más de 3 tipos)
            $table->date('joined_at');         // 6. Fecha de unión (Date) - Tipo 5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
