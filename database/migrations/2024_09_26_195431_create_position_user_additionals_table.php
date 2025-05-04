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
        Schema::create('position_user_additionals', function (Blueprint $table) {
            $table->foreignId('position_user_id')->nullable()->constrained('position_users');
            $table->foreignId('additional_id')->nullable()->constrained('additionals');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_user_additionals');
    }
};
