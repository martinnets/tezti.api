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
        Schema::create('position_user_skill_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_user_id')->nullable()->constrained('position_users');
            $table->foreignId('skill_id')->nullable()->constrained('skills');
            $table->decimal('result')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_user_skill_results');
    }
};
