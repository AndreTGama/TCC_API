<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class functions_has_type_users extends Model
{
    protected $table = 'functions_has_type_users';

    protected $fillable = [
        'type_users_id_type_user',
        'functions_id_function',
    ];

    protected $guarded = [
        'id_function_has_type_user',
        'created_at',
        'updated_at',
    ];
}
