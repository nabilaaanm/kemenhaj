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
            if (Schema::hasColumn('berhak_lunas', 'kbihu')) {
                $table->dropColumn('kbihu');
            }
        });

        Schema::table('berhak_lunas', function (Blueprint $table) {
            if (Schema::hasColumn('berhak_lunas', 'nomor_porsi')) {
                $table->unique('nomor_porsi', 'berhak_lunas_nomor_porsi_unique');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        Schema::table('berhak_lunas', function (Blueprint $table) {
            if (Schema::hasColumn('berhak_lunas', 'nomor_porsi')) {
                $table->dropUnique('berhak_lunas_nomor_porsi_unique');
            }
            if (!Schema::hasColumn('berhak_lunas', 'kbihu')) {
                $table->string('kbihu')->nullable()->after('keterangan');
            }
        });
    }
};
