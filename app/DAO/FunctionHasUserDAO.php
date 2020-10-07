<?php

namespace App\DAO;

use Illuminate\Support\Facades\DB;

class FunctionHasUserDAO
{
    public function verifyFunctions(int $typeUser) : object
    {
        $queryListFuntions = DB::table('functions_has_type_users')
                            ->join('type_users', 'type_users.id_type_user', 'functions_has_type_users.type_users_id_type_user')
                            ->join('functions', 'functions.id_function', 'functions_has_type_users.functions_id_function')
                            ->where('functions_has_type_users.active', true)
                            ->where('type_users.id_type_user', $typeUser)
                            ->select('functions.id_function', 'functions.function')->get();

        return $queryListFuntions;
    }
}
