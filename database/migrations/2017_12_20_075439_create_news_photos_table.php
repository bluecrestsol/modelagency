<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            /*
            new_id
            filename
            order_id
            updated_by_admin_id
            created_by_admin_id
            */
            $table->integer('news_id')->unsigned();
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
        Schema::dropIfExists('news_photos');
    }
}
