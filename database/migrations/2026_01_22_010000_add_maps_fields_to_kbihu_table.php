<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kbihu', function (Blueprint $table) {
            if (!Schema::hasColumn('kbihu', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('telp');
            }
            if (!Schema::hasColumn('kbihu', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('kbihu', 'maps_url')) {
                $table->string('maps_url')->nullable()->after('longitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kbihu', function (Blueprint $table) {
            if (Schema::hasColumn('kbihu', 'maps_url')) {
                $table->dropColumn('maps_url');
            }
            if (Schema::hasColumn('kbihu', 'longitude')) {
                $table->dropColumn('longitude');
            }
            if (Schema::hasColumn('kbihu', 'latitude')) {
                $table->dropColumn('latitude');
            }
        });
    }
};
