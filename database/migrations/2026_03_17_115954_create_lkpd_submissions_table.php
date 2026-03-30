<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lkpd_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('aktivitas_id')->constrained('aktivitas')->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_name');
            $table->timestamps();

            $table->unique(['user_id', 'aktivitas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lkpd_submissions');
    }
};