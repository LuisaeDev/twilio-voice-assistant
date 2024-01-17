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
        Schema::create('call_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('sid');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('agent_id')->nullable();
            $table->string('recording_url')->nullable();
            $table->string('recording_sid')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('agent_id')->references('id')->on('agents');

            // Indexes
            $table->index('sid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_tracks');
    }
};
