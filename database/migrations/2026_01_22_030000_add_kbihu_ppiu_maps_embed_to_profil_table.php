<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            if (!Schema::hasColumn('profil', 'maps_embed_kbihu')) {
                $table->text('maps_embed_kbihu')->nullable()->after('maps_embed');
            }
            if (!Schema::hasColumn('profil', 'maps_embed_ppiu')) {
                $table->text('maps_embed_ppiu')->nullable()->after('maps_embed_kbihu');
            }
        });
    }

    public function down(): void
    {
        Schema::table('profil', function (Blueprint $table) {
            if (Schema::hasColumn('profil', 'maps_embed_ppiu')) {
                $table->dropColumn('maps_embed_ppiu');
            }
            if (Schema::hasColumn('profil', 'maps_embed_kbihu')) {
                $table->dropColumn('maps_embed_kbihu');
            }
        });
    }
};
