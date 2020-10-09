<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class type_users extends Model
{
    protected $table = 'type_users';

    protected $fillable = [
        'type_user',
    ];

    protected $cast = 'id_type_user';
}
