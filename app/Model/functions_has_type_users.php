<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class functions_has_type_users extends Model
{
    protected $table = 'functions_has_type_users';

    protected $fillable = [
        'street',
        'number',
        'district',
        'city',
        'state',
        'country'
     ];
}
