<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        Schema::table('berhak_lunas', function (Blueprint $table) {
            if (!Schema::hasColumn('berhak_lunas', 'nama_ayah')) {
                $table->string('nama_ayah')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('berhak_lunas', 'keterangan')) {
                $table->string('keterangan')->nullable()->after('status');
            }
            if (!Schema::hasColumn('berhak_lunas', 'kbihu')) {
                $table->string('kbihu')->nullable()->after('keterangan');
            }
            if (!Schema::hasColumn('berhak_lunas', 'nomor_paspor')) {
                $table->string('nomor_paspor')->nullable()->after('kbihu');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        Schema::table('berhak_lunas', function (Blueprint $table) {
            if (Schema::hasColumn('berhak_lunas', 'nomor_paspor')) {
                $table->dropColumn('nomor_paspor');
            }
            if (Schema::hasColumn('berhak_lunas', 'kbihu')) {
                $table->dropColumn('kbihu');
            }
            if (Schema::hasColumn('berhak_lunas', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
            if (Schema::hasColumn('berhak_lunas', 'nama_ayah')) {
                $table->dropColumn('nama_ayah');
            }
        });
    }
};
