<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['regulasi', 'regulations'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('order');
                });
                break;
            }
        }

        foreach (['layanan', 'services'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('order');
                });
                break;
            }
        }
    }

    public function down(): void
    {
        foreach (['regulasi', 'regulations'] as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->integer('order')->default(0);
                });
                break;
            }
        }

        foreach (['layanan', 'services'] as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'order')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->integer('order')->default(0);
                });
                break;
            }
        }
    }
};
