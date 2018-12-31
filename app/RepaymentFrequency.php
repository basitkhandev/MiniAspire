<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepaymentFrequency extends Model
{
    protected $table = 'repayments_frequency';
    protected $primary_key = 'frequency_id';

    public $timestamps = true;
    //
}
