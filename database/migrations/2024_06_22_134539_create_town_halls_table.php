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
        Schema::create('town_halls', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8)->unique();
            $table->string('ekatte', 5);
            $table->string('name', 64);
            $table->unsignedBigInteger('municipality_id');
            $table->timestamps();
            $table->unique(['name', 'municipality_id']);
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('town_halls');
    }
};
