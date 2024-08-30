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
        Schema::create('departement', function (Blueprint $table) {
            $table->tinyIncrements('id_departement');
            $table->string('kode_dept', 3);
            $table->string('nama_dept', 40);
            $table->text('desk_dept');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement');
    }
};
