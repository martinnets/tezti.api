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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hierarchical_level_id')->nullable()->constrained('hierarchical_levels');
            $table->string('name');
            $table->date('from');
            $table->date('to');
            $table->integer('status')->default(1);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
