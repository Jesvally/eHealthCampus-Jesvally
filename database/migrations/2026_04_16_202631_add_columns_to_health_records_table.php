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
        Schema::table('health_records', function (Blueprint $table) {
            // Menambahkan kolom detak dan tensi setelah user_id
            $table->integer('detak')->after('user_id'); // Untuk Heart Rate
            $table->string('tensi')->after('detak');    // Untuk Blood Pressure
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('health_records', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['detak', 'tensi']);
        });
    }
};