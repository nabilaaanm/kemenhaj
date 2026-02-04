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
        Schema::create('haji_jamaahs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_porsi')->nullable()->index();
            $table->string('nama')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('kbihu')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kelurahan')->nullable()->index();
            $table->string('kecamatan')->nullable()->index();
            $table->unsignedInteger('usia')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->unsignedSmallInteger('tahun_keberangkatan')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('haji_jamaahs');
    }
};
