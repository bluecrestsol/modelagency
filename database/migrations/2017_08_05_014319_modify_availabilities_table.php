<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function(Blueprint $table) {
            $table->integer('agency_id')->nullable();
            $table->renameColumn('from', 'starts_at');
            $table->renameColumn('to', 'ends_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availabilities', function(Blueprint $table) {
            $table->dropColumn('agency_id');
            $table->renameColumn('starts_at', 'from');
            $table->renameColumn('ends_at', 'to');
        });
    }
}
