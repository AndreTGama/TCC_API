<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class opening_hours extends Model
{
    protected $table = 'opening_hours';

    protected $fillable = [
        'open',
        'close',
        'lunch_time_out',
        'lunch_time_in'
    ];

    protected $guarded = [
        'id_opening_hour',
        'created_at',
        'updated_at',
    ];
}
