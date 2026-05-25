<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->renameIfExists('galleries', 'galeri');
        $this->renameIfExists('gallery_categories', 'galeri_kategori');
        $this->renamePostingCategories();
        $this->renameIfExists('regulations', 'regulasi');
        $this->renameIfExists('services', 'layanan');
    }

    public function down(): void
    {
        $this->renameIfExists('layanan', 'services');
        $this->renameIfExists('regulasi', 'regulations');
        $this->renamePostingCategoriesBack();
        $this->renameIfExists('galeri_kategori', 'gallery_categories');
        $this->renameIfExists('galeri', 'galleries');
    }

    private function renameIfExists(string $from, string $to): void
    {
        if (Schema::hasTable($from) && !Schema::hasTable($to)) {
            Schema::rename($from, $to);
        }
    }

    private function renamePostingCategories(): void
    {
        if (!Schema::hasTable('posting_categories') || Schema::hasTable('posting_kategori')) {
            return;
        }

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_id')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }

        Schema::rename('posting_categories', 'posting_kategori');

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_id')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('posting_kategori')->nullOnDelete();
            });
        }
    }

    private function renamePostingCategoriesBack(): void
    {
        if (!Schema::hasTable('posting_kategori') || Schema::hasTable('posting_categories')) {
            return;
        }

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_id')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }

        Schema::rename('posting_kategori', 'posting_categories');

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_id')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('posting_categories')->nullOnDelete();
            });
        }
    }
};
