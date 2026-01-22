<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ppiu', function (Blueprint $table) {
            if (!Schema::hasColumn('ppiu', 'direktur')) {
                $table->string('direktur')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('ppiu', 'kantor_pusat')) {
                $table->string('kantor_pusat')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('ppiu', 'no_telp')) {
                $table->string('no_telp')->nullable()->after('kantor_pusat');
            }
            if (!Schema::hasColumn('ppiu', 'terakreditasi')) {
                $table->string('terakreditasi')->nullable()->after('no_telp');
            }
            if (!Schema::hasColumn('ppiu', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('terakreditasi');
            }
            if (!Schema::hasColumn('ppiu', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('ppiu', 'maps_url')) {
                $table->string('maps_url')->nullable()->after('longitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ppiu', function (Blueprint $table) {
            if (Schema::hasColumn('ppiu', 'maps_url')) {
                $table->dropColumn('maps_url');
            }
            if (Schema::hasColumn('ppiu', 'longitude')) {
                $table->dropColumn('longitude');
            }
            if (Schema::hasColumn('ppiu', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('ppiu', 'terakreditasi')) {
                $table->dropColumn('terakreditasi');
            }
            if (Schema::hasColumn('ppiu', 'no_telp')) {
                $table->dropColumn('no_telp');
            }
            if (Schema::hasColumn('ppiu', 'kantor_pusat')) {
                $table->dropColumn('kantor_pusat');
            }
            if (Schema::hasColumn('ppiu', 'direktur')) {
                $table->dropColumn('direktur');
            }
        });
    }
};
