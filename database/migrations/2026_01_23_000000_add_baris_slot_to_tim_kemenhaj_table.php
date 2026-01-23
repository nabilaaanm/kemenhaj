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
        Schema::table('tim_kemenhaj', function (Blueprint $table) {
            if (!Schema::hasColumn('tim_kemenhaj', 'baris')) {
                $table->unsignedTinyInteger('baris')->nullable()->after('urutan');
            }
            if (!Schema::hasColumn('tim_kemenhaj', 'slot')) {
                $table->unsignedTinyInteger('slot')->nullable()->after('baris');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tim_kemenhaj', function (Blueprint $table) {
            if (Schema::hasColumn('tim_kemenhaj', 'slot')) {
                $table->dropColumn('slot');
            }
            if (Schema::hasColumn('tim_kemenhaj', 'baris')) {
                $table->dropColumn('baris');
            }
        });
    }
};
