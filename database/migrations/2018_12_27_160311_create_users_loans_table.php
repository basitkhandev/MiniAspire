<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id_fk')->unsigned();
            $table->integer('loan_amount')->unsigned();
            $table->integer('interest_rate_id_fk')->unsigned();
            $table->integer('arrangement_fee_id_fk')->unsigned();
            $table->integer('repayment_frequency_id_fk')->unsigned();
            $table->integer('duration');
            $table->enum('status',['active','deactivate'])->default('active');
            $table->timestamps();

            $table->foreign('user_id_fk')->references('id')->on('users');
//            $table->foreign('loan_id_fk')->references('loan_id')->on('loans');
            $table->foreign('interest_rate_id_fk')->references('interest_rate_id')->on('interest_rate');
            $table->foreign('arrangement_fee_id_fk')->references('arrangement_fee_id')->on('arrangement_fee');
            $table->foreign('repayment_frequency_id_fk')->references('frequency_id')->on('repayments_frequency');
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
        Schema::dropIfExists('users_loans');
        //
    }
}
