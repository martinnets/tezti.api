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
        Schema::table('position_users', function (Blueprint $table) {
            $table->boolean('is_observed')->nullable()->after('status');
            $table->text('observed_comments')->nullable()->after('is_observed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('position_users', function (Blueprint $table) {
            $table->dropColumn('is_observed');
            $table->dropColumn('observed_comments');
        });
    }
};
