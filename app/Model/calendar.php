<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class calendar extends Model
{
    protected $table = 'calendars';

    protected $guarded = [
        'id_calendar',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'day_commitment',
        'hour_commitment',
        'note',
        'users_id_user',
        'services_companies_id_services_company',
    ];
}
