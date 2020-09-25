<?php

namespace App\DAO;

use App\Model\verify_code;
use Illuminate\Support\Facades\DB;

class VerifyCodeDAO
{
     /**
     * consultCode
     *
     * @param  array $dados
     * @return object
     */
    public function consultCode(array $dados) : ?object
    {
        $queryCode = verify_code::where($dados)->first();
        return $queryCode;
    }
    /**
     * createUser
     *
     * @param  array $dados
     * @return object
     */
    public function createVerifyCode(array $dados) : object
    {
        $queryCode = verify_code::create($dados);
        return $queryCode;
    }

}
