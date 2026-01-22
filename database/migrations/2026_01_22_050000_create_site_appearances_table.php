<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_appearances', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color', 20)->default('#ECB176');
            $table->enum('mode', ['light', 'dark'])->default('light');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_appearances');
    }
};
