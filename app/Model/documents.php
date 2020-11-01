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

    protected $guarded = [
        'id_document',
        'created_at',
        'updated_at',
    ];
}
