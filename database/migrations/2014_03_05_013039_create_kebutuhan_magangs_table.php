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
        Schema::create('kebutuhan_magangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seksi_id')->nullable()->constrained('seksis')->onDelete('cascade');
            $table->string('kebutuhan');
            $table->longText('detail');
            $table->string('kualifikasi');
            $table->string('output')->nullable();
            $table->integer('kuota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_magangs');
    }
};
