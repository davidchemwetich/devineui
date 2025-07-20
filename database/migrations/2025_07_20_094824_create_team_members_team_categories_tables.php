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
        // Team Categories Table
        Schema::create('team_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);                   // Category name: Founder, Church Council, etc.
            $table->string('slug', 255)->unique();          // Slug for URL or UI filtering
            $table->boolean('is_featured')->default(false); // Whether this category should be featured at the top
            $table->timestamps();
        });

        // Team Members Table
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_category_id')
                ->nullable()
                ->constrained('team_categories')
                ->nullOnDelete();                          // If category deleted, member becomes uncategorized
            $table->string('name', 255);                   // Team member's full name
            $table->string('role', 255);                   // Their role: Senior Pastor, Council Member, etc.
            $table->string('location', 255)->nullable();    // NEW: Member's location
            $table->string('profile_image')->nullable();     // Path to uploaded image
            $table->string('email')->nullable();              // Email address
            $table->string('phone')->nullable();           // Phone number
            $table->string('whatsapp')->nullable();        // WhatsApp number or URL
            $table->string('facebook_url')->nullable();    // Facebook profile link
            $table->integer('order')->default(0);          // Manual sorting order
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status field
            $table->foreignId('last_updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete(); // User who last updated (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('team_categories');
    }
};