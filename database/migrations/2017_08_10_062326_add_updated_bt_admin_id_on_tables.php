<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedBtAdminIdOnTables extends Migration
{
    /**
     * Run the migrations.
     *
        agencies
        customers
        ethnicities
        eyes
        hairs
        models
        models_images (here add also created_by_admin_id)
        notes

     * @return void
     */
    public function up()
    {
        Schema::table('agencies', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('customers', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('ethnicities', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('eyes', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('hairs', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('models', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

        Schema::table('models_photos', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
            $table->integer('created_by_admin_id');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->integer('updated_by_admin_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agencies', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('customers', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('ethnicities', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('eyes', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('hairs', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('models', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });

        Schema::table('models_photos', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
            $table->dropColumn('created_by_admin_id');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->dropColumn('updated_by_admin_id');
        });
    }
}
