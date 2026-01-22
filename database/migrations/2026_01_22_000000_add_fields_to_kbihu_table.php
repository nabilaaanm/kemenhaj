<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kbihu', function (Blueprint $table) {
            if (!Schema::hasColumn('kbihu', 'tahun_berdiri')) {
                $table->string('tahun_berdiri')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('kbihu', 'nama_pimpinan')) {
                $table->string('nama_pimpinan')->nullable()->after('tahun_berdiri');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kbihu', function (Blueprint $table) {
            if (Schema::hasColumn('kbihu', 'nama_pimpinan')) {
                $table->dropColumn('nama_pimpinan');
            }
            if (Schema::hasColumn('kbihu', 'tahun_berdiri')) {
                $table->dropColumn('tahun_berdiri');
            }
        });
    }
};
