<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class users_has_comunicateds extends Model
{
    protected $fillable = [
        'users_id_user',
        'comunicateds_id_comunicated',
        'users_has_comunicateds_id'


    ];
    protected $cast =[
        'id_user_has_comunicated'
    ];
}