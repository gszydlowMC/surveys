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

        Schema::create('user_groups', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('allow_create_user')->nullable();
            $table->boolean('allow_edit')->nullable();
            $table->boolean('allow_statistics')->nullable();
        });

        DB::table('user_groups')->insert([
            ['name' => 'Administrator', 'description' => 'Administrator', 'is_admin' => true, 'allow_create_user' => true, 'allow_edit' => true, 'allow_statistics' => true],
            ['name' => 'Edytor', 'is_admin' => false, 'allow_create_user' => false, 'allow_edit' => true, 'allow_statistics' => true],
            ['name' => 'Analityk danych', 'is_admin' => false, 'allow_create_user' => false, 'allow_edit' => false, 'allow_statistics' => true],
        ]);

        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_group_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_superadmin')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        //konto domyslne adminowe
        DB::table('users')->insert([
            [
                'user_group_id' => 1,
                'concession_id' => null,
                'first_name' => 'Grzegorz',
                'last_name' => 'Szydłowski',
                'email' => 'grzegorz.szydlowski@mediacyfrowe.pl',
                //Haslo123#
                'password' => '$2y$10$wq8I9UbnikXGdLKShX8dY.vsxCX3zOeT5zQQY5mL/j89ocOIvdalC',
                'active' => 1,
                'is_superadmin' => 1,
            ],
        ]);


        Schema::create('user_permissions', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('survey_id');
        });

        Schema::create('surveys', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->comment('Kto dodał subskrybenta');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_sections', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('survey_id');
            $table->integer('survey_section_id');
            $table->smallInteger('field_type');
            $table->text('label');
            $table->string('title')->nullable();
            $table->smallInteger('position');
            $table->boolean('is_required')->nullable();
            $table->integer('max')->nullable();
            $table->integer('min')->nullable();
            $table->string('customRules')->nullable();
            $table->string('default_value')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_question_options', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('survey_question_id');
            $table->text('value');
            $table->string('title')->nullable();
            $table->boolean('is_default');
            $table->boolean('is_radio');
            $table->boolean('is_checkbox');
            $table->smallInteger('position');
            $table->timestamps();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->comment('Kto dodał subskrybenta');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('group_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_sends', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id')->comment('Kto wykonał wysylke ankiety');
            $table->integer('survey_id');
            $table->integer('subscriber_id');
            $table->string('survey_subscribe_token')->unique();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });

        Schema::create('response_survey', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('subscriber_id');
            $table->integer('survey_id');
            $table->text('serialize_survey')->nullable();
            $table->boolean('is_opened_survey')->nullable();
            $table->boolean('is_closed_survey')->nullable();
            $table->boolean('is_not_send_next')->nullable();
            $table->timestamps();
        });

        Schema::create('response_survey_question', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('subscriber_id');
            $table->integer('survey_id');
            $table->integer('survey_section_id');
            $table->integer('survey_question_id');
            $table->string('value')->nullable();
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
