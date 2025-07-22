<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_days', function (Blueprint $table) {
            $table->id();
            $table->string('day')->unique(); // e.g., Sunday, Monday
            $table->timestamps();
        });

        Schema::create('service_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_day_id')
                ->constrained('service_days')
                ->onDelete('cascade');
            $table->string('time');      // e.g., 8:00 AM - 10:00 AM
            $table->string('name');      // e.g., Main Service
            $table->string('language');  // e.g., English
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_times');
        Schema::dropIfExists('service_days');
    }
};