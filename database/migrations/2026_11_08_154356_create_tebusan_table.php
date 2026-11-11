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
        Schema::create('tebusan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('id_kredit_limit')->nullable();
            $table->foreign('id_kredit_limit')
                ->references('id')
                ->on('kredit_limit');
            $table->string('nama_pt')->nullable();
            $table->string('nomor_sh')->nullable();
            $table->string('nomor_tebusan')->nullable();
            $table->string('metode_tebusan')->nullable();
            $table->string('status_tebusan')->nullable();
            $table->date('tanggal')->nullable();
            $table->date('tanggal_so')->nullable();
            $table->string('nomor_qt')->nullable();
            $table->string('nomor_so')->nullable();
            $table->decimal('total_tebusan', 30, 2)->nullable();
            $table->date('tanggal_berita_acara')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->smallInteger('total_jumlah_tebusan')->nullable();
            $table->date('tanggal_pelunasan_tebusan')->nullable();
            $table->decimal('harga_pelunasan', 30, 2)->nullable();
            $table->string('form_permintaan')->nullable();
            $table->string('form_qt')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tebusan');
    }
};
