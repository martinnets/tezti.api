<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScormProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorm_progress', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignId('scorm_package_id')->constrained('scorm_packages')->onDelete('cascade');
            $table->string('user_id')->nullable();
            $table->string('scorm_package_id')->nullable();
            $table->string('location')->nullable();
            $table->string('completion_status')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('suspend_data')->nullable();
            $table->string('total_time')->nullable();
            $table->timestamp('last_accessed_at')->nullable();
            $table->timestamps();
            
            // Índice para búsqueda rápida
            //$table->unique(['user_id', 'scorm_package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scorm_progress');
    }
}