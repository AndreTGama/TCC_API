<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class documents extends Model
{
    protected $table = 'documents';

    protected $fillable = [
       'cpf',
       'cnpj'
    ];
}
