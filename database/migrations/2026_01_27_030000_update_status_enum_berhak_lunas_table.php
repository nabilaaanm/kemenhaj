<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        DB::table('berhak_lunas')
            ->where('status', 'Menunggu')
            ->update(['status' => 'Cadangan']);

        DB::table('berhak_lunas')
            ->whereIn('status', ['Berhak Lunas', 'Tidak Berhak'])
            ->update(['status' => 'Bukan Cadangan']);

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE `berhak_lunas` MODIFY `status` ENUM('Cadangan','Bukan Cadangan') NOT NULL DEFAULT 'Cadangan'");
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('berhak_lunas')) {
            return;
        }

        DB::table('berhak_lunas')
            ->where('status', 'Cadangan')
            ->update(['status' => 'Menunggu']);

        DB::table('berhak_lunas')
            ->where('status', 'Bukan Cadangan')
            ->update(['status' => 'Berhak Lunas']);

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE `berhak_lunas` MODIFY `status` ENUM('Berhak Lunas','Menunggu','Tidak Berhak') NOT NULL DEFAULT 'Berhak Lunas'");
        }
    }
};
