<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCreatedByAdminIdOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->renameColumn('created_by_admin_id', 'admin_id');
        });
        Schema::table('agencies', function (Blueprint $table) {
            $table->renameColumn('created_by_admin_id', 'admin_id');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('created_by_admin_id', 'admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->renameColumn('admin_id', 'created_by_admin_id');
        });
        Schema::table('agencies', function (Blueprint $table) {
            $table->renameColumn('admin_id', 'created_by_admin_id');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('admin_id', 'created_by_admin_id');
        });
    }
}
