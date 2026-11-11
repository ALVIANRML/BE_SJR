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
        Schema::create('item_tebusan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_stok')
                ->foreign('id_stok')
                ->references('id')
                ->on('stok');
            $table->uuid('id_tebusan')
                ->foreign('id_tebusan')
                ->references('id')
                ->on('tebusan');
            $table->string('jumlah')->nullable();
            $table->decimal('harga', 30, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_tebusan');
    }
};
