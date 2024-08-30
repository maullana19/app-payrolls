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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->tinyIncrements('id_penggajian');
            $table->unsignedTinyInteger('id_absensi');
            $table->tinyInteger('total_hari')->default(0);
            $table->tinyInteger('total_lembur')->default(0);
            $table->decimal('gaji_kotor', 10, 2)->default(0);
            $table->decimal('total_potongan', 10, 2)->default(0);
            $table->decimal('total_gaji_bersih', 10, 2)->default(0);
            $table->date('tgl_gaji');
            $table->timestamps();

            $table->foreign('id_absensi')->references('id_absensi')->on('absensi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
