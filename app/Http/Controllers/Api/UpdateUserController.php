<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\AddressesDAO;
use App\DAO\ContactsDAO;
use App\DAO\DocumentsDAO;
use App\DAO\ServicesDAO;
use App\DAO\UsersDAO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    /**
     * updateUser
     *
     * @param  mixed $request
     * @return void
     */
    public function updateUser(Request $request)
    {
        $usersDAO = new UsersDAO();
        $addressDAO = new AddressesDAO();
        $contacsDAO = new ContactsDAO();
        $docuemtsDAO = new DocumentsDAO();

        $data = $this->validate($request, [
            'login' => ['required'],
            'password' => ['required'],
            'nameUser' => ['required'],
            'email' => ['required'],
            'birthDate' => ['required'],
            'typeUsersId' => ['required', 'integer'],
            'postCode' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required'],
            'dddTel' => ['required','max:4'],
            'dddCel' => ['required','max:4'],
            'telNumber' => ['required','max:9'],
            'celNumber' => ['required','max:10'],
            'idUser' => ['required', 'integer']
        ]);

        $data = $request->all();

        $login = $data['login'];
        $password = $data['password'];
        $nameUser = $data['nameUser'];
        $email = $data['email'];
        $birthDate = $data['birthDate'];
        $typeUsersId = $data['typeUsersId'];
        $postcode = $data['postCode'];
        $street = $data['street'];
        $number = $data['number'];
        $district = $data['district'];
        $city = $data['city'];
        $state = $data['state'];
        $country = $data['country'];
        $dddTel = $data['dddTel'];
        $dddCel = $data['dddCel'];
        $telNumber = $data['telNumber'];
        $celNumber = $data['celNumber'];
        $cpf = $data['cpf'];
        $cnpj = $data['cnpj'];
        $idUser = $data['idUser'];

        $infoUser = $usersDAO->verifyIdUser($idUser);

        $idDocs = $infoUser->documents_id_document;
        $typeUser = $infoUser->type_users_id_type_user;


        $dadosAddress = [
            'postcode' => $postcode,
            'street' => $street,
            'number' => $number,
            'district' => $district,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ];

        $queryConsultAddress = $addressDAO->consultAddresses($dadosAddress);

        if(empty($queryConsultAddress)) {
            $queryCreateAddress = $addressDAO->createAddresses($dadosAddress);
            $adressesId = $queryCreateAddress->id;
        } else $adressesId = $queryConsultAddress->id_address;

        $dadosDocuments = [
            'cpf' => $cpf,
            'cnpj' => $cnpj,
        ];

        if(!isset($cpf) && !isset($cnpj)) return ReturnMessage::messageReturn(true,'Campos vazios',null,null, null);

        $queryConsultDocuments = $docuemtsDAO->consultDocuments($dadosDocuments);

        if(empty($queryConsultDocuments)) {
            $queryCreateDocuments = $docuemtsDAO->createDocuments($dadosDocuments);
            $idDocs = $queryCreateDocuments->id;
        } else {
            $documentsId = $queryConsultDocuments->id_document;
            if($idDocs != $documentsId) return ReturnMessage::messageReturn(true,'CPF/CNPJ já está em uso',null,null, null);
        }


        $dadosUser = [
            'login' => $login,
            'password' => bcrypt($password),
            'name_user' => $nameUser,
            'e-mail' => $email,
            'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $birthDate))),
            'documents_id_document' => $idDocs,
            'addresses_id_address' => $adressesId,
            'type_users_id_type_user' => $typeUsersId
        ];

        $usersDAO->updateUser($idUser, $dadosUser);


        $dadosContacts = [
            'ddd_tel' => $dddTel,
            'ddd_cel' => $dddCel,
            'tel_number' => $telNumber,
            'cel_number' => $celNumber,
            'users_id_user' => $idUser
        ];

        $queryContactsUser = $contacsDAO->consultContact($dadosContacts);

        if(empty($queryContactsUser)) $contacsDAO->updateContact($idUser ,$dadosContacts);

        return ReturnMessage::messageReturn(false,'Cadastro Feito com Sucesso',null,null, null);
    }
}
