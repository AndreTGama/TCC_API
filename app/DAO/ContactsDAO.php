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
        $queryContacts = contacts::where($dados)->first();
        return $queryContacts;
    }
    /**
     * createContact
     *
     * @param  array $dados
     * @return object
     */
    public function createContact(array $dados) : object
    {
        $queryContacts = contacts::create($dados);
        return $queryContacts;
    }
    /**
     * updateContact
     *
     * @param  int $idContacs
     * @param  array $dados
     * @return object
     */
    public function updateContact(int $idContacs, array $dados) : object
    {
        $queryContacts = contacts::where($idContacs)->update($dados);
        return $queryContacts;
    }
    /**
     * listContactUser
     *
     * @param  int $idUser
     * @return array
     */
    public function listContactUser(int $idUser) : array
    {
        $queryContacts = contacts::where('users_id_user', '=', $idUser)
                        ->select('id_contact','ddd_tel','ddd_cel','tel_number', 'cel_number')
                        ->get()->toArray();
        return $queryContacts;
    }
}
