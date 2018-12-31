<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRepaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_repayment', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id_fk')->unsigned();
            $table->integer('users_loans_fk')->unsigned();
            $table->string('users_payable_payments');
            $table->enum('status',['paid','unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('user_id_fk')->references('id')->on('users');
            $table->foreign('users_loans_fk')->references('id')->on('users_loans');
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
        Schema::dropIfExists('users_repayment');
        //
    }
}
