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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('ekatte', 5)->unique();
            $table->string('name', 64);
            $table->unsignedBigInteger('settlement_kind_id');
            $table->unsignedBigInteger('town_hall_id');
            $table->unsignedBigInteger('municipality_id');
            $table->unsignedBigInteger('district_id');
            $table->unique(['name', 'town_hall_id']);
            $table->timestamps();
            $table->foreign('settlement_kind_id')->references('id')->on('settlement_kinds')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreign('town_hall_id')->references('id')->on('town_halls')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
