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
        Schema::create('berhak_lunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor_porsi');
            $table->string('provinsi');
            $table->enum('status', ['Berhak Lunas', 'Menunggu', 'Tidak Berhak'])->default('Berhak Lunas');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berhak_lunas');
    }
};
