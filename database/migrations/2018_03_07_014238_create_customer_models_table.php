<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_model', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('model_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('vote')->comment('1=like, 2=dislike');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_models');
    }
}
