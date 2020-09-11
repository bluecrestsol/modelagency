<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFieldsToNullableOnModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('models', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->integer('model_share')->nullable()->change();
            $table->integer('status')->comment('0=disabled, 1=active, 2=invisible, 3=submission in progress, 4=submitted')->nullable()->change();
            $table->integer('doc_type')->comment('1=passport, 2=id card, 3=drivers license')->nullable()->change();
            $table->string('doc_number')->nullable()->change();
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
            $table->string('password')->change();
            $table->integer('model_share')->change();
            $table->integer('status')->comment('0=not available, 1=available')->change();
            $table->integer('doc_type')->comment('1=passport, 2=id card, 3=drivers license')->change();
            $table->string('doc_number')->change();
        });
    }
}
