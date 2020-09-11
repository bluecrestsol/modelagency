<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTablesPerTask0004558 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //remove created_by_admin_id on etchnicities, eyes, hairs
        Schema::table('ethnicities', function (Blueprint $table) {
            $table->dropColumn('created_by_admin_id');
        });

        Schema::table('eyes', function (Blueprint $table) {
            $table->dropColumn('created_by_admin_id');
        });

        Schema::table('hairs', function (Blueprint $table) {
            $table->dropColumn('created_by_admin_id');
        });

        //add created_by_admin_id on models_files
        Schema::table('models_files', function (Blueprint $table) {
            $table->integer('created_by_admin_id')->unsigned()->nullable();
        });

        //Remove also from table file_types: owner_id
        Schema::table('file_types', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //remove created_by_admin_id on etchnicities, eyes, hairs
        Schema::table('ethnicities', function (Blueprint $table) {
            $table->integer('created_by_admin_id')->unsigned()->nullable();
        });

        Schema::table('eyes', function (Blueprint $table) {
            $table->integer('created_by_admin_id')->unsigned()->nullable();
        });

        Schema::table('hairs', function (Blueprint $table) {
            $table->integer('created_by_admin_id')->unsigned()->nullable();
        });

        //add created_by_admin_id on models_files
        Schema::table('models_files', function (Blueprint $table) {
            $table->dropColumn('created_by_admin_id');
        });

        //Remove also from table file_types: owner_id
        Schema::table('file_types', function (Blueprint $table) {
            $table->integer('owner_id')->unsigned()->nullable();
        });
    }
}
