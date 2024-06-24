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
        $tableNames = config('permission.table_names');

        Schema::create('permission_translations', function (Blueprint $table) use ($tableNames) {
            $table->id();
            $table->unsignedBigInteger('permission_id');
            $table->string('locale')->index();
            $table->string('display_name');
            $table->unique(['permission_id', 'locale']);
            $table->foreign('permission_id')->references('id')->on($tableNames['permissions'])
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_translations');
    }
};
