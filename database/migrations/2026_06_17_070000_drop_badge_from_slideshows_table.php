<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('slideshows') || !Schema::hasColumn('slideshows', 'badge')) {
            return;
        }

        Schema::table('slideshows', function (Blueprint $table) {
            $table->dropColumn('badge');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('slideshows') || Schema::hasColumn('slideshows', 'badge')) {
            return;
        }

        Schema::table('slideshows', function (Blueprint $table) {
            $table->string('badge')->nullable()->after('title');
        });
    }
};
