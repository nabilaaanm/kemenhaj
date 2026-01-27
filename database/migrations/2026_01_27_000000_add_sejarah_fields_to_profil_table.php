<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('profil')) {
            return;
        }

        Schema::table('profil', function (Blueprint $table) {
            if (!Schema::hasColumn('profil', 'sejarah_judul')) {
                $table->string('sejarah_judul')->nullable()->after('struktur_gambar');
            }
            if (!Schema::hasColumn('profil', 'sejarah_subjudul')) {
                $table->string('sejarah_subjudul')->nullable()->after('sejarah_judul');
            }
            if (!Schema::hasColumn('profil', 'sejarah_konten')) {
                $table->text('sejarah_konten')->nullable()->after('sejarah_subjudul');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('profil')) {
            return;
        }

        Schema::table('profil', function (Blueprint $table) {
            if (Schema::hasColumn('profil', 'sejarah_konten')) {
                $table->dropColumn('sejarah_konten');
            }
            if (Schema::hasColumn('profil', 'sejarah_subjudul')) {
                $table->dropColumn('sejarah_subjudul');
            }
            if (Schema::hasColumn('profil', 'sejarah_judul')) {
                $table->dropColumn('sejarah_judul');
            }
        });
    }
};
