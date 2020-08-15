<?php

namespace App\DAO;

use App\Model\users;

class UsersDAO
{
     /**
     * consultUsers
     *
     * @param  array $dados
     * @return object
     */
    public function consultUsers(array $dados) : ?object
    {
        $queryDocuments = users::where($dados)->first();
        return $queryDocuments;
    }
    /**
     * createUser
     *
     * @param  array $dados
     * @return object
     */
    public function createUser(array $dados) : object
    {
        $queryDocuments = users::create($dados);
        return $queryDocuments;
    }
}
