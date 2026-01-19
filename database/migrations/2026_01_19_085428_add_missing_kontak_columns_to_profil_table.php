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
        Schema::table('profil', function (Blueprint $table) {
            if (!Schema::hasColumn('profil', 'struktur_subjudul')) {
                $table->string('struktur_subjudul')->nullable()->after('struktur_organisasi');
            }
            if (!Schema::hasColumn('profil', 'struktur_gambar')) {
                $table->string('struktur_gambar')->nullable()->after('struktur_subjudul');
            }
            if (!Schema::hasColumn('profil', 'alamat_keterangan')) {
                $table->string('alamat_keterangan')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('profil', 'telepon_alt')) {
                $table->string('telepon_alt')->nullable()->after('telepon');
            }
            if (!Schema::hasColumn('profil', 'maps_url')) {
                $table->string('maps_url')->nullable()->after('email');
            }
            if (!Schema::hasColumn('profil', 'maps_embed')) {
                $table->text('maps_embed')->nullable()->after('maps_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            if (Schema::hasColumn('profil', 'struktur_subjudul')) {
                $table->dropColumn('struktur_subjudul');
            }
            if (Schema::hasColumn('profil', 'struktur_gambar')) {
                $table->dropColumn('struktur_gambar');
            }
            if (Schema::hasColumn('profil', 'alamat_keterangan')) {
                $table->dropColumn('alamat_keterangan');
            }
            if (Schema::hasColumn('profil', 'telepon_alt')) {
                $table->dropColumn('telepon_alt');
            }
            if (Schema::hasColumn('profil', 'maps_url')) {
                $table->dropColumn('maps_url');
            }
            if (Schema::hasColumn('profil', 'maps_embed')) {
                $table->dropColumn('maps_embed');
            }
        });
    }
};
