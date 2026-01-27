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
            if (Schema::hasColumn('berhak_lunas', 'provinsi')) {
                $table->dropColumn('provinsi');
            }
            if (Schema::hasColumn('berhak_lunas', 'order')) {
                $table->dropColumn('order');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        Schema::table('berhak_lunas', function (Blueprint $table) {
            if (!Schema::hasColumn('berhak_lunas', 'provinsi')) {
                $table->string('provinsi')->default('-')->after('nomor_porsi');
            }
            if (!Schema::hasColumn('berhak_lunas', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
        });
    }
};
