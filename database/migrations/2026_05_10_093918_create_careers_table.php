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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('required_skills')->nullable();
            $table->string('education_requirements')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('job_outlook')->nullable();
            $table->string('work_environment')->nullable();
            $table->json('personality_matches')->nullable();
            $table->json('aptitude_requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
