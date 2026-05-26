<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instagram_posts', function (Blueprint $table) {
            $table->string('thumbnail_url')->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('instagram_posts', function (Blueprint $table) {
            $table->dropColumn('thumbnail_url');
        });
    }
};
