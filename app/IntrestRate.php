<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntrestRate extends Model
{
    //

    protected $table = 'interest_rate';
    protected $primary_key = 'interest_rate_id';

    public $timestamps = true;
}
