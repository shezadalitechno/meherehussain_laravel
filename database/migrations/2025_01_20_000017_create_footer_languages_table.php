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
        Schema::create('footer_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('footer_setting_id')->constrained('footer_settings')->onDelete('cascade');
            $table->string('language');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index('footer_setting_id');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_languages');
    }
};

