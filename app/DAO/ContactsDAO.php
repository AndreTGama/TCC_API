<?php

namespace App\DAO;

use App\Model\contacts;

class ContactsDAO
{
 /**
     * consultContact
     *
     * @param  array $dados
     * @return object
     */
    public function consultContact(array $dados) : ?object
    {
        $queryDocuments = contacts::where($dados)->first();
        return $queryDocuments;
    }
    /**
     * createContact
     *
     * @param  array $dados
     * @return object
     */
    public function createContact(array $dados) : object
    {
        $queryDocuments = contacts::create($dados);
        return $queryDocuments;
    }
    public function updateContact(int $idContacs, array $dados) : object
    {
        $queryDocuments = contacts::where($idContacs)->update($dados);
        return $queryDocuments;
    }
}
