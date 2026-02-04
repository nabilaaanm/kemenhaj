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
        if (!Schema::hasTable('haji_jamaahs')) {
            return;
        }

        Schema::table('haji_jamaahs', function (Blueprint $table) {
            if (Schema::hasColumn('haji_jamaahs', 'status_keberangkatan')) {
                $table->dropColumn('status_keberangkatan');
            }
            if (Schema::hasColumn('haji_jamaahs', 'tanggal_keberangkatan')) {
                $table->dropColumn('tanggal_keberangkatan');
            }
            if (Schema::hasColumn('haji_jamaahs', 'bulan_keberangkatan')) {
                $table->dropColumn('bulan_keberangkatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('haji_jamaahs')) {
            return;
        }

        Schema::table('haji_jamaahs', function (Blueprint $table) {
            if (!Schema::hasColumn('haji_jamaahs', 'bulan_keberangkatan')) {
                $table->unsignedTinyInteger('bulan_keberangkatan')->nullable()->index();
            }
            if (!Schema::hasColumn('haji_jamaahs', 'tanggal_keberangkatan')) {
                $table->date('tanggal_keberangkatan')->nullable();
            }
            if (!Schema::hasColumn('haji_jamaahs', 'status_keberangkatan')) {
                $table->string('status_keberangkatan')->nullable();
            }
        });
    }
};
