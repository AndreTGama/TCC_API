<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class functions extends Model
{
    protected $table = 'functions';

    protected $fillable = [
       'function','functions_id_function'
    ];

    protected $guarded = [
        'id_function',
        'created_at',
        'updated_at',
    ];
}
