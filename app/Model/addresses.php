<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class addresses extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'postcode',
        'street',
        'number',
        'district',
        'city',
        'state',
        'country'
    ];

    protected $guarded = [
        'id_address',
        'created_at',
        'updated_at',
    ];
}
