<?php

namespace App\Http\Controllers\Api;

use App\DAO\AddressesDAO;
use App\DAO\ContactsDAO;
use App\DAO\DocumentsDAO;
use App\DAO\UsersDAO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function createUser(Request $request)
    {
        $usersDAO = new UsersDAO();
        $addressDAO = new AddressesDAO();
        $contacsDAO = new ContactsDAO();
        $docuemtsDAO = new DocumentsDAO();

        // $data = $this->validate($request, [
        //     'login' => ['required'],
        //     'password' => ['required'],
        //     'nameUser' => ['required'],
        //     'email' => ['required'],
        //     'birthDate' => ['required'],
        //     'typeUsersId' => ['required', 'integer'],
        //     'street' => ['required'],
        //     'number' => ['required'],
        //     'district' => ['required'],
        //     'city' => ['required'],
        //     'state' => ['required'],
        //     'country' => ['required'],
        //     'dddTel' => ['required','max:3'],
        //     'dddCel' => ['required','max:3'],
        //     'telNumber' => ['required','max:9'],
        //     'celNumber' => ['required','max:10']
        // ]);

        $data = $request->all();

        $login = $data['login'];
        $password = $data['password'];
        $nameUser = $data['nameUser'];
        $email = $data['email'];
        $birthDate = $data['birthDate'];
        $typeUsersId = $data['typeUsersId'];
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

        $dadosAddress = [
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

        if(!isset($cpf) && !isset($cnpj)) return dd('Vazios');

        $queryConsultDocuments = $docuemtsDAO->consultDocuments($dadosDocuments);

        if(empty($queryConsultDocuments)) {
            $queryCreateDocuments = $docuemtsDAO->createDocuments($dadosDocuments);
            $documentsId = $queryCreateDocuments->id;
        } else $documentsId = $queryConsultDocuments->id_document;


        $dadosUser = [
            'login' => $login,
            'password' => $password,
            'name_user' => $nameUser,
            'e-mail' => $email,
            'birth_date' => $birthDate,
            'documents_id_document' => $documentsId,
            'addresses_id_address' => $adressesId,
            'type_users_id_type_user' => $typeUsersId
        ];

        $queryConsultUser = $usersDAO->consultUsers($dadosUser);

        if(empty($queryConsultUser)) {
            $queryCreateUser = $usersDAO->createUser($dadosUser);
            $userId = $queryCreateUser->id;
        } else $userId = $queryConsultUser->id_user;

        $dadosContacts = [
            'ddd_tel' => $dddTel,
            'ddd_cel' => $dddCel,
            'tel_number' => $telNumber,
            'cel_number' => $celNumber,
            'users_id_user' => $userId
        ];

        $queryContactsUser = $contacsDAO->consultContact($dadosContacts);

        if(empty($queryContactsUser)) $queryCreateUser = $contacsDAO->createContact($dadosContacts);

        dd('Foi');
    }
}
