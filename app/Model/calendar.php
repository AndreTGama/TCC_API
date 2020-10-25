<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class calendar extends Model
{
    protected $cast = [
        'id_calendar'
    ];

    protected $fillable = [
        'day_commitment',
        'hour_commitment',
        'note',
        'users_id_user',
        'services_companies_id_services_company',
    ];

    protected $table = 'calendars';

}
