<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class addresses extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
       'street',
       'number',
       'district',
       'city',
       'state',
       'country'
    ];

}
