<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('aktivitas_id')->constrained('aktivitas')->cascadeOnDelete();
            $table->boolean('materi_completed')->default(false);
            $table->boolean('lkpd_completed')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'aktivitas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_progress');
    }
};