<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->timestamps();
            $table->integer('created_by_admin_id');
            $table->timestamp('last_logged_at')->nullable();
            $table->string('name');
            $table->tinyInteger('status')->comment('0=disabled, 1=enabled, 2=blacklisted');
            $table->integer('share');
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zip')->nullable();
            $table->integer('country_id');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('website')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tax_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
