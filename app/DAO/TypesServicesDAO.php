<?php

namespace App\DAO;

use App\Model\types_services;
use Illuminate\Support\Facades\DB;

class TypesServicesDAO
{
    /**
     * listTypeUsers
     *
     * @return object
     */
    public function listTypeUsers() : object
    {
        $queryTypeUsers = types_services::all()->where('active', '=', true);

        return $queryTypeUsers;
    }
}
