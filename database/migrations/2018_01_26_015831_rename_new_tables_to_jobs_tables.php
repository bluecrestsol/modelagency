<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNewTablesToJobsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('news', 'jobs');
        Schema::rename('news_clips', 'jobs_clips');
        Schema::rename('news_photos', 'jobs_photos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('jobs', 'news');
        Schema::rename('jobs_clips', 'news_clips');
        Schema::rename('jobs_photos', 'news_photos');
    }
}
