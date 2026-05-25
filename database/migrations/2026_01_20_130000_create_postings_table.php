<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('postings')) {
            return;
        }

        Schema::create('postings', function (Blueprint $table) {
            $table->id();
            $table->string('category_slug')->nullable();
            $table->foreign('category_slug')->references('slug')->on('posting_kategori')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('editor_name')->nullable();
            $table->string('contributor_name')->nullable();
            $table->string('photographer_name')->nullable();
            $table->string('writer_name')->nullable();
            $table->string('location')->nullable();
            $table->string('source')->nullable();
            $table->date('published_at')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postings');
    }
};
