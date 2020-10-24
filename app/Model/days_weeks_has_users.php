<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class days_weeks_has_users extends Model
{
    protected $table = 'days_weeks_has_users';

    protected $fillable = [
        'users_id_user',
        'days_weeks_id_days_week',
        'opening_hours_id_opening_hour',
        'active'
    ];
    protected $guarded = [
        'id_days_weeks_has_users',
        'creaed_at',
        'updated_at',
    ];
}
