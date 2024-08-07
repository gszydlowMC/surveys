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
        Schema::table('surveys', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('description');
            $table->string('banner_path')->nullable()->after('description');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
