<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Regions Table
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Clusters Table
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained()->cascadeOnDelete();
            $table->string('cluster_name');
            $table->timestamps();
        });

        // Churches Table (Belongs to a Cluster and Region)
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained()->cascadeOnDelete(); // Link to Region
            $table->foreignId('cluster_id')->constrained()->cascadeOnDelete(); // Link to Cluster
            $table->string('name');
            $table->string('thumbnail')->nullable(); // Church Thumbnail Image
            $table->text('google_map_iframe')->nullable(); // Embed Google Map iframe
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // Many-to-Many Relationship for Church Leaders (Users can be church leaders for multiple churches)
        Schema::create('church_church_leader_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Jetstream User (Church Leader)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_church_leader_user');
        Schema::dropIfExists('churches');
        Schema::dropIfExists('clusters');
        Schema::dropIfExists('regions');
    }
};