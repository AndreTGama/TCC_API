<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class verify_code extends Model
{
    protected $table='verify_codes';

    protected $fillable = [
		'code','users_id_user'
    ];

    protected $guarded = [
        'id_verify_code',
        'created_at',
        'updated_at',
    ];
}

