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
        Schema::table('survey_tokens', function (Blueprint $table) {
            $table->foreignId('subscriber_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->after('subscriber_id')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
