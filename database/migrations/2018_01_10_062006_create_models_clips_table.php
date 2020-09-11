<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsClipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_clips', function (Blueprint $table) {
           $table->increments('id');
           $table->timestamps();
           $table->integer('model_id')->unsigned();
           $table->string('filename');
           $table->integer('order_id')->unsigned();
           $table->integer('updated_by_admin_id')->unsigned()->nullable();
           $table->integer('created_by_admin_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models_clips');
    }
}
