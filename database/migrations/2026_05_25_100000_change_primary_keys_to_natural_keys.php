<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->migrateBerhakLunas();
        $this->migrateCustomPages();
        $this->migrateGaleriKategori();
        $this->migrateHajiJamaahs();
        $this->migrateKbihu();
        $this->migratePpiu();
        $this->migrateProfil();
        $this->migrateRegulasi();
        $this->migrateLayanan();
        $this->migrateSlideshows();
        $this->migrateTimKemenhaj();
        $this->migrateUsers();
    }

    public function down(): void
    {
        // Reverting natural keys to auto-increment id is not supported safely.
    }

    private function migrateBerhakLunas(): void
    {
        if (!Schema::hasTable('berhak_lunas') || !Schema::hasColumn('berhak_lunas', 'id')) {
            return;
        }

        DB::table('berhak_lunas')->whereNull('nomor_porsi')->orWhere('nomor_porsi', '')->delete();

        $this->dropIdAndSetPrimary('berhak_lunas', 'nomor_porsi');
    }

    private function migrateCustomPages(): void
    {
        if (!Schema::hasTable('custom_pages') || !Schema::hasColumn('custom_pages', 'id')) {
            return;
        }

        $this->dropIdAndSetPrimary('custom_pages', 'slug');
    }

    private function migrateGaleriKategori(): void
    {
        if (!Schema::hasTable('galeri_kategori') || !Schema::hasColumn('galeri_kategori', 'id')) {
            return;
        }

        $this->dropIdAndSetPrimary('galeri_kategori', ['type', 'name']);
    }

    private function migrateHajiJamaahs(): void
    {
        if (!Schema::hasTable('haji_jamaahs') || !Schema::hasColumn('haji_jamaahs', 'id')) {
            return;
        }

        DB::table('haji_jamaahs')->whereNull('nomor_porsi')->orWhere('nomor_porsi', '')->delete();

        $dupes = DB::table('haji_jamaahs')
            ->select('nomor_porsi', DB::raw('COUNT(*) as total'))
            ->groupBy('nomor_porsi')
            ->having('total', '>', 1)
            ->pluck('nomor_porsi');

        foreach ($dupes as $nomorPorsi) {
            $rows = DB::table('haji_jamaahs')->where('nomor_porsi', $nomorPorsi)->orderByDesc('updated_at')->get();
            foreach ($rows->slice(1) as $row) {
                DB::table('haji_jamaahs')->where('id', $row->id)->delete();
            }
        }

        $this->dropIdAndSetPrimary('haji_jamaahs', 'nomor_porsi');
    }

    private function migrateKbihu(): void
    {
        if (!Schema::hasTable('kbihu') || !Schema::hasColumn('kbihu', 'id')) {
            return;
        }

        $this->dedupeByColumn('kbihu', 'nama');
        $this->dropIdAndSetPrimary('kbihu', 'nama');
    }

    private function migratePpiu(): void
    {
        if (!Schema::hasTable('ppiu') || !Schema::hasColumn('ppiu', 'id')) {
            return;
        }

        $this->dedupeByColumn('ppiu', 'no_izin');
        $this->dropIdAndSetPrimary('ppiu', 'no_izin');
    }

    private function migrateProfil(): void
    {
        if (!Schema::hasTable('profil') || !Schema::hasColumn('profil', 'id')) {
            return;
        }

        if (!Schema::hasColumn('profil', 'kode')) {
            Schema::table('profil', function (Blueprint $table) {
                $table->string('kode', 50)->default('utama')->after('id');
            });
        }

        DB::table('profil')->update(['kode' => 'utama']);

        $rows = DB::table('profil')->orderBy('id')->get();
        foreach ($rows->slice(1) as $row) {
            DB::table('profil')->where('id', $row->id)->delete();
        }

        $this->dropIdAndSetPrimary('profil', 'kode');
    }

    private function migrateRegulasi(): void
    {
        if (!Schema::hasTable('regulasi') || !Schema::hasColumn('regulasi', 'id')) {
            return;
        }

        $this->dedupeByColumns('regulasi', ['title', 'regulation_date']);
        $this->dropIdAndSetPrimary('regulasi', ['title', 'regulation_date']);
    }

    private function migrateLayanan(): void
    {
        if (!Schema::hasTable('layanan') || !Schema::hasColumn('layanan', 'id')) {
            return;
        }

        $this->dedupeByColumn('layanan', 'name');
        $this->dropIdAndSetPrimary('layanan', 'name');
    }

    private function migrateSlideshows(): void
    {
        if (!Schema::hasTable('slideshows') || !Schema::hasColumn('slideshows', 'id')) {
            return;
        }

        $this->dedupeByColumn('slideshows', 'title');
        $this->dropIdAndSetPrimary('slideshows', 'title');
    }

    private function migrateTimKemenhaj(): void
    {
        if (!Schema::hasTable('tim_kemenhaj') || !Schema::hasColumn('tim_kemenhaj', 'id')) {
            return;
        }

        $this->dedupeByColumns('tim_kemenhaj', ['nama', 'jabatan']);
        $this->dropIdAndSetPrimary('tim_kemenhaj', ['nama', 'jabatan']);
    }

    private function migrateUsers(): void
    {
        if (!Schema::hasTable('users') || !Schema::hasColumn('users', 'id')) {
            return;
        }

        if (Schema::hasTable('sessions') && Schema::hasColumn('sessions', 'user_id')) {
            $map = DB::table('users')->pluck('email', 'id');
            DB::table('sessions')->whereNotNull('user_id')->orderBy('id')->chunk(200, function ($sessions) use ($map) {
                foreach ($sessions as $session) {
                    $email = $map[$session->user_id] ?? null;
                    if ($email) {
                        DB::table('sessions')->where('id', $session->id)->update(['user_id' => $email]);
                    }
                }
            });

            DB::statement('ALTER TABLE `sessions` MODIFY `user_id` VARCHAR(255) NULL');
        }

        $this->dropIdAndSetPrimary('users', 'email');
    }

    private function dedupeByColumn(string $table, string $column): void
    {
        $dupes = DB::table($table)
            ->select($column, DB::raw('COUNT(*) as total'))
            ->groupBy($column)
            ->having('total', '>', 1)
            ->pluck($column);

        foreach ($dupes as $value) {
            $rows = DB::table($table)->where($column, $value)->orderByDesc('updated_at')->get();
            foreach ($rows->slice(1) as $row) {
                DB::table($table)->where('id', $row->id)->delete();
            }
        }
    }

    private function dedupeByColumns(string $table, array $columns): void
    {
        $rows = DB::table($table)->get();
        $seen = [];
        foreach ($rows as $row) {
            $key = implode('|', array_map(fn ($col) => (string) $row->{$col}, $columns));
            if (isset($seen[$key])) {
                DB::table($table)->where('id', $row->id)->delete();
                continue;
            }
            $seen[$key] = true;
        }
    }

    private function dropIdAndSetPrimary(string $table, string|array $primary): void
    {
        DB::statement("ALTER TABLE `{$table}` MODIFY `id` BIGINT UNSIGNED NOT NULL");

        Schema::table($table, function (Blueprint $blueprint) {
            $blueprint->dropPrimary(['id']);
        });

        Schema::table($table, function (Blueprint $blueprint) {
            $blueprint->dropColumn('id');
        });

        Schema::table($table, function (Blueprint $blueprint) use ($primary) {
            if (is_array($primary)) {
                $blueprint->primary($primary);
            } else {
                $blueprint->primary($primary);
            }
        });
    }
};
