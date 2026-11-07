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
        Schema::create('item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('id_segment');
            $table->foreign('id_segment')
            ->references('id')
            ->on('segment');
            $table->string('nama_item');
            $table->string('kemasan');
            $table->decimal('jumlah_liter',10,2);
            $table->decimal('harga_jual', 30,2);
            $table->decimal('harga_tebus', 30,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
