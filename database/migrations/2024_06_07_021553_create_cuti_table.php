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
        Schema::create('cuti', function (Blueprint $table) {
            $table->tinyIncrements('id_cuti');
            $table->unsignedTinyInteger('id_karyawan');
            $table->enum('jenis_cuti', ['cuti tahunan', 'cuti sakit', 'cuti melahirkan', 'cuti lainnya'])->default('cuti tahunan');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->tinyInteger('lama_cuti')->default(0);
            $table->string('foto_cuti', 255)->nullable();
            $table->text('alasan_cuti');
            $table->timestamps();

            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
