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
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('group')->default('header');
            $table->string('cover_image')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('contributor')->nullable();
            $table->string('editor')->nullable();
            $table->string('source')->nullable();
            $table->string('photographer')->nullable();
            $table->text('other_info')->nullable();
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
        Schema::dropIfExists('custom_pages');
    }
};
