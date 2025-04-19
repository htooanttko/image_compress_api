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
        Schema::create('compression_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('message');
            $table->enum('status', ['success', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compression_logs');
    }
};
