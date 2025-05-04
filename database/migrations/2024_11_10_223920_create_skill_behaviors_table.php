<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skill_behaviors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->nullable()->constrained('skills');
            $table->foreignId('behavior_id')->nullable()->constrained('behaviors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_behaviors');
    }
};
