<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('regulations') && Schema::hasColumn('regulations', 'order')) {
            Schema::table('regulations', function (Blueprint $table) {
                $table->dropColumn('order');
            });
        }

        if (Schema::hasTable('services') && Schema::hasColumn('services', 'order')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropColumn('order');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('regulations') && !Schema::hasColumn('regulations', 'order')) {
            Schema::table('regulations', function (Blueprint $table) {
                $table->integer('order')->default(0);
            });
        }

        if (Schema::hasTable('services') && !Schema::hasColumn('services', 'order')) {
            Schema::table('services', function (Blueprint $table) {
                $table->integer('order')->default(0);
            });
        }
    }
};
