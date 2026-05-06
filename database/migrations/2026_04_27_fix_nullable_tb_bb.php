<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration ini memperbaiki kolom tb dan bb agar nullable.
 * Jalankan: php artisan migrate
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // tb (tinggi badan) dan bb (berat badan) bersifat opsional saat register
            $table->integer('tb')->nullable()->change();
            $table->integer('bb')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('tb')->nullable(false)->change();
            $table->integer('bb')->nullable(false)->change();
        });
    }
};
