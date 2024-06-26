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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('mahasiswa');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('seksi_id')->nullable()->constrained('seksis')->onDelete('cascade');
            $table->foreignId('kebutuhan_magang_id')->nullable()->constrained('kebutuhan_magangs')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim')->nullable();
            $table->integer('jenis_kelamin')->nullable();
            $table->integer('semester')->nullable();
            $table->string('perguruan_tinggi')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('pembimbing')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->integer('status')->default(0);
            $table->string('pengetahuan')->nullable();
            $table->string('keterampilan')->nullable();
            $table->string('komunikasi')->nullable();
            $table->string('problem_solve')->nullable();
            $table->string('bimbingan')->nullable();
            $table->string('gambaran_kerja')->nullable();
            $table->string('waktu_diskusi')->nullable();
            $table->string('pengarahan')->nullable();
            $table->string('wifi')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('saran_pembimbing')->nullable();
            $table->string('saran_pelaksanaan')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
