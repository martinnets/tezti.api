<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (config('database.default') === 'pgsql') {
            DB::statement("CREATE EXTENSION IF NOT EXISTS unaccent;");
        }
    }

    public function down(): void
    {
        if (config('database.default') === 'pgsql') {
            DB::statement("DROP EXTENSION IF EXISTS unaccent;");
        }
    }
};
