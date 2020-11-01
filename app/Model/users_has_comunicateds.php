<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users_has_comunicateds extends Model
{
    protected $table = 'users_has_comunicateds';
    
    protected $fillable = [
        'users_id_user',
        'comunicateds_id_comunicated'


    ];

    protected $guarded = [
        'id_user_has_comunicated',
        'created_at',
        'updated_at',
    ];
}
