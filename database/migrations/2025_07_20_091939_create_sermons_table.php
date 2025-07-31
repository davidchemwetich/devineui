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
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('preached_on')->nullable();

            // Media Resources
            $table->string('audio_path')->nullable();
            $table->string('video_url')->nullable();
            $table->string('pdf_path')->nullable();

            // Cover image
            $table->string('cover_image')->nullable();

            // Featured sermon flag
            $table->boolean('is_featured')->default(false);

            // Category (Added missing values from your form)
            $table->enum('category', ['Faith', 'Family', 'End Times', 'Worship', 'Prayer', 'Other'])->nullable();

            // Status (Added missing column from your form/model)
            $table->string('status')->default('draft');

            $table->timestamps();

            // This line adds the `deleted_at` column required for Soft Deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};