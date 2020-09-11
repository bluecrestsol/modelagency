<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUpdatedByAdminIdOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ethnicities', function (Blueprint $table) { $table->dropColumn('updated_by_admin_id'); });
        Schema::table('eyes', function (Blueprint $table) { $table->dropColumn('updated_by_admin_id'); });
        Schema::table('hairs', function (Blueprint $table) { $table->dropColumn('updated_by_admin_id'); });
        Schema::table('notes', function (Blueprint $table) { $table->dropColumn('updated_by_admin_id'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ethnicities', function (Blueprint $table) { $table->integer('updated_by_admin_id')->nullable(); });
        Schema::table('eyes', function (Blueprint $table) { $table->integer('updated_by_admin_id')->nullable(); });
        Schema::table('hairs', function (Blueprint $table) { $table->integer('updated_by_admin_id')->nullable(); });
        Schema::table('notes', function (Blueprint $table) { $table->integer('updated_by_admin_id')->nullable(); });
    }
}
