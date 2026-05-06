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
        Schema::create('sleep_records', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->time('sleep_time'); // Jam tidur
    $table->time('wake_time');  // Jam bangun
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sleep_records');
    }
};
