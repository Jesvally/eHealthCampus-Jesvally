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
    Schema::table('sleep_records', function (Blueprint $table) {
        $table->date('date')->after('wake_time');
    });
    }

    public function down(): void
    {
    Schema::table('sleep_records', function (Blueprint $table) {
        $table->dropColumn('date');
    });
    }
};
