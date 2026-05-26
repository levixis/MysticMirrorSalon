<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Instagram CDN URLs can be 500+ characters, varchar(255) is too short
        if (Schema::hasColumn('instagram_posts', 'thumbnail_url')) {
            DB::statement('ALTER TABLE instagram_posts ALTER COLUMN thumbnail_url TYPE text');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('instagram_posts', 'thumbnail_url')) {
            DB::statement('ALTER TABLE instagram_posts ALTER COLUMN thumbnail_url TYPE varchar(255)');
        }
    }
};
