<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFieldsOnJobsClipsAndJobsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs_clips', function (Blueprint $table) {
            $table->renameColumn('news_id', 'job_id');
        });

        Schema::table('jobs_photos', function (Blueprint $table) {
            $table->renameColumn('news_id', 'job_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs_clips', function (Blueprint $table) {
            $table->renameColumn('job_id', 'news_id');
        });

        Schema::table('jobs_photos', function (Blueprint $table) {
            $table->renameColumn('job_id', 'news_id');
        });
    }
}
