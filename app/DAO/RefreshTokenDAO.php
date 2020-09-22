<?php

namespace App\DAO;

use App\Model\refresh_token;

class RefreshTokenDAO
{
    /**
     * createToken
     *
     * @param  array $dados
     * @return object
     */
    public function createToken(array $dados) : object
    {
        $queryToken = refresh_token::create($dados);
        return $queryToken;
    }
}
