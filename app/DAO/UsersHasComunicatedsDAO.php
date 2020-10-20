<?php

namespace App\DAO;

use App\Model\users_has_comunicateds;
use App\Model\usershascomunicated;
use Illuminate\Support\Facades\DB;

class UsersHasComunicatedsDAO
{
    /**
     * createComunicated
     *
     * @param  array $dados
     * @return object
     */
    public function createUsersComunicated(array $dados) : object
    {
        $queryUsers_has_comunicated = users_has_comunicateds::create($dados);
        return $queryUsers_has_comunicated;
    }

}
