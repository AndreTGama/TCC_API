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
    public function consultUser(array $dados) : ?object
    {
        $queryUser = users::where([
                ['login', '=', $dados['login']],
                ['e-mail', '=', $dados['e-mail']]
            ])->first();
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
     * @param  string $login
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
    /**
     * verifyIdUser
     *
     * @param  int $idUser
     * @return object
     */
    public function verifyIdUser(int $idUser) : ?object
    {
        $queryUser = users::where('id_user', '=', $idUser)->first();

        return $queryUser;
    }
    /**
     * updateUser
     *
     * @param  int $idUser
     * @param  array <
     *         string login,
     *         string password,
     *         string name_user,
     *         string e-mail,
     *         date birth_date,
     *         number documents_id_document,
     *         number addresses_id_address,
     *         number type_users_id_type_user
     * > $dados
     * @return object
     */
    public function updateUser(int $idUser, array $dados) : ?object
    {
        $queryUpdateUser = users::where('id_user', '=', $idUser)->update($dados);

        return $queryUpdateUser;
    }
    public function listUsersInSystemForType(int $typeUser = null) : ?object
    {
        $queryListUser = DB::table('users')
                        ->join('type_users', 'type_users.id_type_user', 'users.type_users_id_type_user')
                        ->where('users.active', '=', true)
                        ->select('users.name_user', 'users.id_user', 'type_users.id_type_user', 'type_users.type_user');
        if($typeUser) $queryListUser = $queryListUser->where('type_users.id_type_user', '=', $typeUser);

        $queryListUser = $queryListUser->get();

        return $queryListUser;
    }

}
