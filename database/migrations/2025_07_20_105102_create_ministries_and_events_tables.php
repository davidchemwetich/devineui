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
        Schema::create('ministries', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Ministry name
            $table->text('description')->nullable(); // Ministry description
            $table->foreignId('leader_id')->nullable()->constrained('users')->nullOnDelete(); // Ministry leader (Jetstream user)
            $table->string('leader_contact')->nullable(); // Leader contact (either email or phone)
            $table->string('primary_image')->nullable(); // Primary image
            $table->json('gallery_images')->nullable(); // JSON array for multiple images
            $table->text('activities')->nullable(); // Ministry activities
            $table->timestamps();
        });

        Schema::create('ministry_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ministry_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('event_date');
            $table->string('location')->nullable();
            $table->string('location_url')->nullable(); // Add this
            $table->json('coordinates')->nullable(); // Add this
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministry_events');
        Schema::dropIfExists('ministries');
    }
};
