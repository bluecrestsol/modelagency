<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameOrderIdToSortingOnModelsPhotosAndJobsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models_photos', function (Blueprint $table) {
            $table->renameColumn('order_id', 'sorting');
        });

        Schema::table('jobs_photos', function (Blueprint $table) {
            $table->renameColumn('order_id', 'sorting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models_photos', function (Blueprint $table) {
            $table->renameColumn('sorting', 'order_id');
        });

        Schema::table('jobs_photos', function (Blueprint $table) {
            $table->renameColumn('sorting', 'order_id');
        });
    }
}
