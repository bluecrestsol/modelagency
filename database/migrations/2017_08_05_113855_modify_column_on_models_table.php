<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnOnModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function(Blueprint $table){
            $table->dropColumn('status');
            $table->integer('location')->comment('1=local, 2=import');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function(Blueprint $table){
            $table->renameColumn('location', 'status');
            $table->integer('status')->comment('0=not available, 1=available')->change();
        });
    }
}
