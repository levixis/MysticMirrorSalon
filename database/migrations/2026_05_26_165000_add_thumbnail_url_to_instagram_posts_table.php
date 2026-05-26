<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('instagram_posts', 'thumbnail_url')) {
            Schema::table('instagram_posts', function (Blueprint $table) {
                $table->text('thumbnail_url')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('instagram_posts', function (Blueprint $table) {
            $table->dropColumn('thumbnail_url');
        });
    }
};
