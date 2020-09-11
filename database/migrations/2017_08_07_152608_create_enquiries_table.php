<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('uuid');
            $table->integer('model_id');
            $table->string('from_name');
            $table->string('from_company')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_mobile')->nullable();
            $table->string('from_ip');
            $table->string('from_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enquiries');
    }

        /*
            id
            uuid (in this case is 8 random only numbers unique)
            created_at
            updates_at
            model_id
            from_name
            from_company
            from_email
            from_mobile
            from_ip
            from_country (2 letters iso)
        */
}
