<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersLoan extends Model
{
    //

    protected $table = 'users_loans';
//    protected $primary_key = 'id';

    public $timestamps = true;

    protected $guarded = ['id'];

}
