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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->unsignedBigInteger('sender_id');
            $table->string('anonymous_name')->unique()->nullable()->default(null);
            $table->string('lokasi');
            $table->text('message');
            $table->enum('status', ['terkirim', 'dibaca', 'diproses', 'selesai'])->default('terkirim');
            $table->enum('roomType', ['public', 'private', 'anonim'])->default('public');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
