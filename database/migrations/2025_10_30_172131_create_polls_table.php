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
        Schema::create('polls', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // səsvermənin başlığı
        $table->text('description')->nullable(); // qısa açıqlama
        $table->date('start_date'); // başlama tarixi
        $table->date('end_date');   // bitmə tarixi
        $table->boolean('is_active')->default(true); // aktiv/passiv
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
