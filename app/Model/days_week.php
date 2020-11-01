<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class days_week extends Model
{
    protected $table = 'days_weeks';

    protected $fillable = [
        'days'
    ];

    protected $guarded = [
        'id_days_week',
        'created_at',
        'updated_at',
    ];
}
