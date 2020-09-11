<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->timestamps();
            $table->integer('admin_id')->nullable();
            $table->timestamp('last_logged_at')->nullable();
            $table->tinyInteger('status')->comment('0=not available, 1=available');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('public_name');
            $table->integer('agency_id')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->integer('country_id');
            $table->integer('sex')->comment('1=male,2=female');
            $table->timestamp('dob')->nullable();
            $table->tinyInteger('doc_type')->comment('1=passport, 2=id card, 3=drivers license');
            $table->string('doc_number');
            $table->timestamp('doc_expire')->nullable();
            $table->integer('ethnicity_id');
            $table->integer('height');
            $table->integer('bust');
            $table->integer('waist');
            $table->integer('hips');
            $table->integer('shoes')->nullable();
            $table->integer('hair_id');
            $table->integer('eyes_id');
            $table->integer('model_share');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
