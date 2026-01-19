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
        if (!Schema::hasColumn('profil', 'struktur_subjudul')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('struktur_subjudul')->nullable()->after('struktur_organisasi');
            });
        }
        if (!Schema::hasColumn('profil', 'struktur_gambar')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('struktur_gambar')->nullable()->after('struktur_subjudul');
            });
        }
        if (!Schema::hasColumn('profil', 'alamat_keterangan')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('alamat_keterangan')->nullable()->after('alamat');
            });
        }
        if (!Schema::hasColumn('profil', 'telepon_alt')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('telepon_alt')->nullable()->after('telepon');
            });
        }
        if (!Schema::hasColumn('profil', 'maps_url')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('maps_url')->nullable()->after('email');
            });
        }
        if (!Schema::hasColumn('profil', 'maps_embed')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->text('maps_embed')->nullable()->after('maps_url');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->dropColumn([
                'struktur_subjudul',
                'struktur_gambar',
                'alamat_keterangan',
                'telepon_alt',
                'maps_url',
                'maps_embed',
            ]);
        });
    }
};
