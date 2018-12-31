<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepaymentsFrequencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repayments_frequency', function (Blueprint $table) {
            $table->increments('frequency_id');
            $table->string('frequency_name');
            $table->enum('status',['active','deactivate'])->default('active');
            $table->timestamps();
        });
        //
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repayments_frequency');
        //
    }
}
