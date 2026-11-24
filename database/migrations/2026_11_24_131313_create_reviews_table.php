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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string("codigo");
            $table->boolean("aceite")->default(false);
            $table->boolean("filtro")->default(false);
            $table->boolean("frenos")->default(false);
            //llave foranea de coche
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')
            ->references('id')
            ->on('cars')
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
        Schema::dropIfExists('reviews');
    }
};
