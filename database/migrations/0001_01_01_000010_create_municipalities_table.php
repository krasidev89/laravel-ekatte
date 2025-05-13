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
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('ekatte', 5);
            $table->string('name', 64);
            $table->unsignedBigInteger('district_id');
            $table->timestamps();
            $table->unique(['name', 'district_id']);
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
        Schema::dropIfExists('municipalities');
    }
};
