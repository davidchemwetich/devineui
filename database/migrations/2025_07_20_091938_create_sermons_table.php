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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Preacher = authenticated user
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('preached_on')->nullable();

            // Media Resources
            $table->string('audio_path')->nullable();  // Path to uploaded audio file
            $table->string('video_url')->nullable();   // YouTube video link
            $table->string('pdf_path')->nullable();    // Path to uploaded PDF file

            // Cover image (e.g., for sermon thumbnail)
            $table->string('cover_image')->nullable();  // Path to the uploaded image file

            // Featured sermon flag
            $table->boolean('is_featured')->default(false); // Whether the sermon is featured

            // Category (e.g., 'Faith', 'Family', 'End Times') as Enum
            $table->enum('category', ['Faith', 'Family', 'End Times', 'Other'])->nullable();

            $table->timestamps();
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
