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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            
            // Mengubah foreignId menjadi foreignUuid agar presisi dengan UUID tabel janji_temus
            $table->foreignUuid('janji_temu_id')->constrained('janji_temus')->onDelete('cascade');
            
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('tindakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};