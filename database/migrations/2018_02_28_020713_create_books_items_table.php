<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('book_id')->unsigned(); //added not on task
            // $table->integer('model_id')->unsigned(); removed, but on task
            $table->integer('models_photo_id')->unsigned()->nullable();
            $table->integer('models_clip_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_items');
    }
}
