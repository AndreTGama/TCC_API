<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class refresh_token extends Model
{
    protected $table = 'refresh_tokens';

    protected $fillable = [
        'refresh_token',
        'active',
        'tokens_id_token'
    ];

    protected $guarded = [
        'id_refresh_token',
        'created_at',
        'updated_at',
    ];
}
