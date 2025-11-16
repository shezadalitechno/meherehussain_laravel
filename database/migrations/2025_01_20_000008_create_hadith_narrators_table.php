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
        Schema::create('hadith_narrators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hadith_id')->constrained('hadith')->onDelete('cascade');
            $table->string('narrator');
            $table->timestamps();
            
            $table->index('hadith_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadith_narrators');
    }
};

