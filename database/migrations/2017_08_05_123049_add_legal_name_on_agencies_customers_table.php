<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLegalNameOnAgenciesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agencies', function(Blueprint $table){
            $table->string('legal_name');
        });
        Schema::table('customers', function(Blueprint $table){
            $table->string('legal_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agencies', function(Blueprint $table){
            $table->dropColumn('legal_name');
        });
        Schema::table('customers', function(Blueprint $table){
            $table->dropColumn('legal_name');
        });
    }
}
