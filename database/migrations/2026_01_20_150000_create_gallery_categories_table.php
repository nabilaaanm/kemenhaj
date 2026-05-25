<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('galeri_kategori')) {
            return;
        }

        Schema::create('galeri_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // foto, video, infografis
            $table->string('name');
            $table->timestamps();

            $table->unique(['type', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_kategori');
    }
};
