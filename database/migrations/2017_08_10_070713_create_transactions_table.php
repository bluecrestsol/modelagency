<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->timestamps();
            $table->timestamp('happened_at')->nullable();
            $table->integer('transaction_type_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->float('amount', 8, 2)->nullable();
            $table->integer('invoice')->comment("0=No, 1=Yes")->nullable();
            $table->integer('vat')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('agency_id')->nullable();
            $table->integer('agency_share')->nullable();
            $table->float('agency_amount', 8, 2)->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('model_share')->nullable();
            $table->float('model_amount', 8, 2)->nullable();
            $table->float('company_amount', 8, 2)->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
