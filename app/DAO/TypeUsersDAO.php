<?php

namespace App\DAO;

use App\Model\type_users;
use Illuminate\Support\Facades\DB;

class TypeUsersDAO
{
    public function listTypeUsers() : object
    {
        $queryTypeUsers = type_users::all();

        return $queryTypeUsers;
    }
}
