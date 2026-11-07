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
        Schema::create('kredit_limit', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('id_segment');
            $table->foreign('id_segment')
            ->references('id')
            ->on('segment');
            $table->decimal('total_kredit',30,2);
            $table->decimal('sisa_limit', 30,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit_limit');
    }
};
