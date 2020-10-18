<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class comunicated extends Model
{
    protected $table = 'comunicateds';

    protected $fillable = [
        'title',
        'comunicated',
        'users_id_user',

    ];
    protected $cast =[
        'id_comunicated'
    ];
}
