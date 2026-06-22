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
        Schema::table('products', function (Blueprint $table) {
            $table->string('tokopedia_url')->nullable()->after('hpp');
            $table->string('shopee_url')->nullable()->after('tokopedia_url');
            $table->string('tiktokshop_url')->nullable()->after('shopee_url');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['tokopedia_url', 'shopee_url', 'tiktokshop_url']);
        });
    }
};
