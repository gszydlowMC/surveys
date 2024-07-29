<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id');
            $table->foreignId('before_question_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id');
            $table->string('field_type');
            $table->text('label');
            $table->smallInteger('position');

            $table->boolean('is_required')->nullable();
            $table->boolean('is_last_on_site')->nullable();

            $table->integer('min_length')->nullable();
            $table->integer('max_length')->nullable();

            $table->string('custom_rules')->nullable();
            $table->string('default_value')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_question_id');
            $table->text('value')->nullable();
            $table->string('label')->nullable();
            $table->boolean('is_default')->nullable();
            $table->boolean('is_radio')->nullable();
            $table->boolean('is_checkbox')->nullable();
            $table->boolean('is_select')->nullable();
            $table->smallInteger('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_sections');
        Schema::dropIfExists('survey_questions');
        Schema::dropIfExists('survey_question_options');
    }
};
