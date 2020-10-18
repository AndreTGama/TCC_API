<?php

namespace App\DAO;

use App\Model\comunicated;

class ComunicatedDAO
{
    /**
     * createComunicated
     *
     * @param  array $dados
     * @return object
     */
    public function createComunicated(array $dados) : object
    {
        $queryComunicated = comunicated::create($dados);
        return $queryComunicated;
    }

}
