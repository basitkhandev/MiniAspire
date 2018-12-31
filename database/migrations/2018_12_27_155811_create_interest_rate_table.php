<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_rate', function (Blueprint $table) {
            $table->increments('interest_rate_id');
            $table->string('interest_rate_name');
            $table->string('interest_ratio');
            $table->enum('status',['active','deactivate'])->default('active');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest_rate');
        //
    }
}
