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
            $table->string('status')->nullable();
            $table->foreignId('agent_id')->nullable();
            $table->string('recording_url')->nullable();
            $table->string('recording_sid')->nullable();



            // $table->string('call_duration')->nullable();
            // $table->string('call_direction')->nullable();
            // $table->string('call_from')->nullable();
            // $table->string('call_to')->nullable();
            // $table->string('call_recording_duration')->nullable();
            // $table->string('call_recording_status')->nullable();
            // $table->string('call_recording_price')->nullable();
            // $table->string('call_recording_price_unit')->nullable();
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
