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
        Schema::create('header_navigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_setting_id')->constrained('header_settings')->onDelete('cascade');
            $table->string('label');
            $table->string('link');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->index('header_setting_id');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_navigations');
    }
};

