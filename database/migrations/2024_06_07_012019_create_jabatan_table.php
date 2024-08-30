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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->tinyIncrements('id_jabatan');
            $table->unsignedTinyInteger('id_departement')->nullable();
            $table->string('nama_jabatan', 30);
            $table->decimal('gaji_harian', 8, 2)->default(0);
            $table->decimal('tunjangan_makan', 7, 2)->default(0);
            $table->decimal('tunjangan_transport', 7, 2)->default(0);
            $table->decimal('tunjangan_kesehatan', 7, 2)->default(0);
            $table->decimal('tunjangan_lainnya', 7, 2)->default(0);
            $table->decimal('bonus', 7, 2)->default(0);
            $table->decimal('gross', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('id_departement')->references('id_departement')->on('departement')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
