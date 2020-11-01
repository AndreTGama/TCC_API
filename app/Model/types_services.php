<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class types_services extends Model
{
    protected $table = 'types_services';

    protected $fillable = [
        'type_service', 'description'
    ];

    protected $cast = 'id_type_service';

}
