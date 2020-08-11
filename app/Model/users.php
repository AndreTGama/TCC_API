<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'users';

    protected $fillable = [
		'id_user',
		'login',
		'password',
        'name_user',
        'e-mail',
        'birth_date'
    ];
}
