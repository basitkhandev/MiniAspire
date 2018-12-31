<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';
    protected $primary_key = 'loan_id';

    public $timestamps = true;
    //
}
