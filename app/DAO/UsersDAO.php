<?php

namespace App\DAO;

use App\Model\users;
use Illuminate\Support\Facades\DB;

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
        $queryUser = users::where($dados)->first();
        return $queryUser;
    }
    /**
     * createUser
     *
     * @param  array $dados
     * @return object
     */
    public function createUser(array $dados) : object
    {
        $queryUser = users::create($dados);
        return $queryUser;
    }
    /**
     * verifyLogin
     *
     * @param  mixed $login
     * @return object
     */
    public function verifyLogin(string $login) : ?object
    {
        $queryUser = DB::table('users')
                            ->where('login', '=', $login)
                            ->where('active', '=', true)
                            ->first();
        return $queryUser;

    }
    public function verifyIdUser(int $idUser) : ?object
    {
        $queryUser = users::where('id_user', '=', $idUser)->first();

        return $queryUser;
    }
}
