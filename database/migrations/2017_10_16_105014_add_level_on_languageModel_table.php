<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLevelOnLanguageModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('language_model', function (Blueprint $table) {
            $table->integer('level')->comment("1=beginner,2=intermediate,3=fluent,4=native");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_model', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }
}
