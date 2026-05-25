<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->integer('subtotal')->default(0)->after('services');
            $table->integer('discount_percent')->default(0)->after('subtotal');
        });

        // Backfill existing receipts: subtotal = total, discount = 0
        \DB::table('receipts')->update([
            'subtotal' => \DB::raw('total'),
        ]);
    }

    public function down(): void
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'discount_percent']);
        });
    }
};
