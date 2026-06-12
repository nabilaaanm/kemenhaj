<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('postings')) {
            return;
        }

        Schema::table('postings', function (Blueprint $table) {
            if (!Schema::hasColumn('postings', 'submitted_by_role')) {
                $table->string('submitted_by_role', 32)->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('postings', 'submitted_by_name')) {
                $table->string('submitted_by_name')->nullable()->after('submitted_by_role');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('postings')) {
            return;
        }

        Schema::table('postings', function (Blueprint $table) {
            if (Schema::hasColumn('postings', 'submitted_by_name')) {
                $table->dropColumn('submitted_by_name');
            }
            if (Schema::hasColumn('postings', 'submitted_by_role')) {
                $table->dropColumn('submitted_by_role');
            }
        });
    }
};
