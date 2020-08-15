<?php

namespace App\DAO;

use App\Model\addresses;

class AddressesDAO
{
    /**
     * consultAdresses
     *
     * @param  array $dados
     * @return object
     */
    public function consultAddresses(array $dados) : ?object
    {
        $queryUsers = addresses::where($dados)->first();
        return $queryUsers;
    }
    /**
     * createAdresses
     *
     * @param  array $dados
     * @return object
     */
    public function createAddresses(array $dados) : object
    {
        $queryAdress = addresses::create($dados);
        return $queryAdress;
    }
}
