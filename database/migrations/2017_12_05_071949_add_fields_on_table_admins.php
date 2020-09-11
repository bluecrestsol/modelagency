<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsOnTableAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('nick_name')->nullable();
            $table->string('mobile')->nullable();
            $table->float('share');
            $table->integer('status')->comment('0=disabled, 1=active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('nick_name');
            $table->dropColumn('mobile');
            $table->dropColumn('share');
            $table->dropColumn('status');
        });
    }
}
