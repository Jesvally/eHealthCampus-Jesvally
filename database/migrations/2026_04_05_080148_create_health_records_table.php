<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            // Menyambungkan catatan kesehatan dengan user/mahasiswa
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // Status kesehatan
            $table->enum('status', ['sehat', 'tidak_sehat']); 
            // Kolom untuk keluhan (bisa dikosongkan)
            $table->text('notes')->nullable(); 
            // Tanggal pencatatan
            $table->date('record_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};