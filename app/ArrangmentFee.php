<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArrangmentFee extends Model
{
    //

    protected $table = 'arrangement_fee';
    protected $primary_key = 'arrangement_fee_id';

    public $timestamps = true;
}
