<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'ddd_tel',
        'ddd_cel',
        'tel_number',
        'cel_number',
        'users_id_user',
    ];

    protected $guarded = [
        'id_contact',
        'created_at',
        'updated_at',
    ];
}
