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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('seksi_id')->nullable()->constrained('seksis')->onDelete('cascade');
            $table->foreignId('kebutuhan_magang_id')->nullable()->constrained('kebutuhan_magangs')->onDelete('cascade');
            $table->string('proposal');
            $table->string('surat_pengantar');
            $table->string('surat_magang')->nullable();
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
