<?php

namespace App\DAO;

use App\Model\token;

class TokenDAO
{
    /**
     * createToken
     *
     * @param  array $dados
     * @return object
     */
    public function createToken(array $dados) : object
    {
        $queryToken = token::create($dados);
        return $queryToken;
    }
    /**
     * deleteToken
     *
     * @param  mixed $idUser
     * @return void
     */
    public function deleteToken(int $idUser) : void
    {
        token::where('users_id_user', '=', $idUser)->delete();
    }
}
