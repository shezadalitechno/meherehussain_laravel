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
        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('chapter_id')->constrained('chapters')->onDelete('cascade');
            $table->json('text_arabic');
            $table->json('text_english');
            $table->json('text_hinglish');
            $table->json('text_urdu')->nullable();
            $table->json('text_hindi')->nullable();
            $table->string('reference_number');
            $table->string('grade')->nullable();
            $table->timestamps();
            
            $table->index('collection_id');
            $table->index('book_id');
            $table->index('chapter_id');
            $table->index('reference_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadiths');
    }
};

