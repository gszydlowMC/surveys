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
        Schema::create('survey_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_id');
            $table->integer('subscriber_id');
            $table->string('token');
            $table->integer('created_by');
            $table->timestamp('created_at');
        });

        Schema::create('survey_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_token_id')->nullable();
            $table->string('view_blade_path')->nullable();
            $table->string('to');
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->json('input_data')->nullable();

            $table->timestamp('sent_at')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('survey_sms', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_token_id')->nullable();
            $table->string('to');
            $table->text('content')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->text('response')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
