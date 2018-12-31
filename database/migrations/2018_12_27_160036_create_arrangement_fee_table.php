<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrangementFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrangement_fee', function (Blueprint $table) {
            $table->increments('arrangement_fee_id');
            $table->string('arrangement_fee_name');
            $table->string('fee');
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
        Schema::dropIfExists('arrangement_fee');
        //
    }
}
