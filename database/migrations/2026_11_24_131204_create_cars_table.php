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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string("marca");
            $table->string("modelo");
            $table->string("color");
            $table->decimal("precio",12,2);
            $table->string('imagen_url');
            $table->string('imagen_public_id');
            //llave foranea de cliente
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
            ->references('id')
            ->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade')
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
