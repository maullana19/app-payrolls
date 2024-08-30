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
        Schema::create('absensi', function (Blueprint $table) {
            $table->tinyIncrements('id_absensi');
            $table->unsignedTinyInteger('id_karyawan');
            $table->date('dari_tanggal');
            $table->date('sampai_tanggal');
            $table->tinyInteger('total_lembur',)->default(0);
            $table->tinyInteger('total_alpa')->default(0);
            $table->tinyInteger('total_hadir')->default(0);
            $table->tinyInteger('total_sakit')->default(0);
            $table->tinyInteger('total_izin')->default(0);
            $table->enum('status_validasi', ['onvalidate', 'validate'])->default('onvalidate');
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
