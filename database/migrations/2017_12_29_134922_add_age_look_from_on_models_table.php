<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgeLookFromOnModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function(Blueprint $table) {
            // $table->integer('age_look_from')->nullable();
            // $table->integer('age_look_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function(Blueprint $table) {
            // $table->dropColumn('age_look_from');
            // $table->dropColumn('age_look_to');
        });
    }
}
