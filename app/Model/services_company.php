<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class services_company extends Model
{
    protected $table = 'services_companies';

    protected $fillable = [
        'id_services_company',
        'service',
        'description',
        'time',
        'price',
        'users_id_user',
        'types_services_id_type_service'
    ];

    protected $guarded = [
        'id_services_company'
    ];

}
