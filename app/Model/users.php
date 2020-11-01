<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';

    protected $fillable = [
		'login',
		'password',
        'name_user',
        'e-mail',
        'birth_date',
        'documents_id_document',
        'addresses_id_address',
        'type_users_id_type_user',
    ];

    protected $dates = ['birth_date', 'created_at', 'updated_at'];

    protected $casts = [
        'birth_date' => 'date:Y-m-d',
    ];

    protected $guarded = [
        'id_user',
        'created_at',
        'updated_at',
    ];

}
