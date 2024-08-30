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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->tinyIncrements('id_karyawan');
            $table->string('nik', 6);
            $table->string('no_ktp', 16);
            $table->string('nama_lengkap', 60);
            $table->date('tgl_lahir');
            $table->string('tempat_lahir', 50);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->default('laki-laki');
            $table->string('email', 80);
            $table->string('no_hp', 16);
            $table->string('agama', 20);
            $table->string('pendidikan_terakhir', 20);
            $table->enum('status_pernikahan', ['menikah', 'belum menikah'])->default('belum menikah');
            $table->enum('status_kerja', ['kontrak', 'tetap',])->default('kontrak');
            $table->string('no_rekening', 16);
            $table->string('npwp', 16);
            $table->unsignedTinyInteger('id_jabatan');
            $table->text('alamat');
            $table->date('tgl_mulai');
            $table->string('foto', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
