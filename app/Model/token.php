<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    protected $table = 'tokens';

    protected $fillable = [
        'token',
        'active',
        'users_id_user'
    ];

    protected $guarded = [
        'id_token',
        'created_at',
        'updated_at',
    ];
}
