<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('posting_kategori')) {
            return;
        }

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_id')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });

            if (!Schema::hasColumn('postings', 'category_slug')) {
                Schema::table('postings', function (Blueprint $table) {
                    $table->string('category_slug')->nullable()->after('id');
                });
            }

            if (Schema::hasColumn('posting_kategori', 'id')) {
                DB::statement('
                    UPDATE postings p
                    INNER JOIN posting_kategori k ON p.category_id = k.id
                    SET p.category_slug = k.slug
                    WHERE p.category_id IS NOT NULL
                ');
            }

            Schema::table('postings', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
        }

        if (Schema::hasColumn('posting_kategori', 'id')) {
            DB::statement('ALTER TABLE `posting_kategori` MODIFY `id` BIGINT UNSIGNED NOT NULL');

            Schema::table('posting_kategori', function (Blueprint $table) {
                $table->dropPrimary(['id']);
            });

            Schema::table('posting_kategori', function (Blueprint $table) {
                $table->dropColumn('id');
            });

            Schema::table('posting_kategori', function (Blueprint $table) {
                $table->primary('slug');
            });
        }

        if (Schema::hasTable('postings') && Schema::hasColumn('postings', 'category_slug')) {
            Schema::table('postings', function (Blueprint $table) {
                $table->foreign('category_slug')->references('slug')->on('posting_kategori')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Reverting is not supported safely.
    }
};
