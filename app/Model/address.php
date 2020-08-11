<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    protected $table = 'address';

    protected $fillable = [
       'street',
       'number',
       'district',
       'city',
       'state',
       'country'
    ];

}
