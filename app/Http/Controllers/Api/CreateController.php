<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\AddressesDAO;
use App\DAO\ContactsDAO;
use App\DAO\DaysHasUsersDAO;
use App\DAO\DocumentsDAO;
use App\DAO\OpenHoursDAO;
use App\DAO\UsersDAO;
use App\DAO\VerifyCodeDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use App\Mail\EmailServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CreateController extends Controller
{
    /**
     * createUser
     *
     * @param  mixed $request
     * @return void
     */
    public function createUser(Request $request)
    {
        $usersDAO = new UsersDAO();
        $addressDAO = new AddressesDAO();
        $contacsDAO = new ContactsDAO();
        $docuemtsDAO = new DocumentsDAO();
        $verifyCodeDAO = new VerifyCodeDAO();
        $mail = new EmailServices();

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
            'celNumber' => ['required','max:10']
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

        $dadosAddress = [
            'postcode' => $postcode,
            'street' => $street,
            'number' => $number,
            'district' => $district,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ];

        DB::beginTransaction();

        $queryConsultAddress = $addressDAO->consultAddresses($dadosAddress);

        if(empty($queryConsultAddress)) {
            $queryCreateAddress = $addressDAO->createAddresses($dadosAddress);
            $adressesId = $queryCreateAddress->id;
        } else $adressesId = $queryConsultAddress->id_address;

        $dadosDocuments = [
            'cpf' => $cpf,
            'cnpj' => $cnpj,
        ];

        if(!isset($cpf) && !isset($cnpj)) {
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Campos vazios',null,null, null);
        }

        $queryConsultDocuments = $docuemtsDAO->consultDocuments($dadosDocuments);

        if(empty($queryConsultDocuments)) {
            $queryCreateDocuments = $docuemtsDAO->createDocuments($dadosDocuments);
            $documentsId = $queryCreateDocuments->id;
        } else {
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Cpf/CNPJ não são válidos',null,null, null);
        }

        $dadosUser = [
            'login' => $login,
            'password' => bcrypt($password),
            'name_user' => $nameUser,
            'e-mail' => $email,
            'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $birthDate))),
            'documents_id_document' => $documentsId,
            'addresses_id_address' => $adressesId,
            'type_users_id_type_user' => $typeUsersId
        ];


        $queryConsultUser = $usersDAO->consultUser($dadosUser);

        if(empty($queryConsultUser)) {
            $queryCreateUser = $usersDAO->createUser($dadosUser);
            $userId = $queryCreateUser->id;

        } else {
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Usuário já existe no sistema',null,null, null);
        }
        $dadosContacts = [
            'ddd_tel' => $dddTel,
            'ddd_cel' => $dddCel,
            'tel_number' => $telNumber,
            'cel_number' => $celNumber,
            'users_id_user' => $userId
        ];

        $queryContactsUser = $contacsDAO->consultContact($dadosContacts);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $codigoConfirmacao = substr(str_shuffle($characters),0,5);
        $dadosCode = [
            'code'=> $codigoConfirmacao,
            'users_id_user'=>$userId
        ];
        $verifyCodeDAO->createVerifyCode($dadosCode);

        $dadosEmail = [
            'name' => $nameUser,
            'email' => $email,
            'subject' => 'Acesso no sistema PlayGama',
            'code' => $codigoConfirmacao,
        ];

        Mail::send($mail->emailNewAccount($dadosEmail));

        if(empty($queryContactsUser)) $queryCreateUser = $contacsDAO->createContact($dadosContacts);

        DB::commit();
        return ReturnMessage::messageReturn(false,'Cadastro Feito com Sucesso',null,null, null);
    }
    /**
     * createDaysToWork
     *
     * @param  mixed $request
     * @return void
     */
    public function createDaysToWork(Request $request)
    {
        $functions = Token::getTokenDecode()->functions;
        $idUser = Token::getTokenDecode()->sub;
        $arrayFuntionsId = [];

        foreach($functions as $function){
            $arrayFuntionsId[] = $function->id_function;
        }

        if(array_search(22, $arrayFuntionsId)) return ReturnMessage::messageReturn(true,'Usuário não tem permissão de acessar essa função',null,null, null);

        $data = $this->validate($request, [
            'daysWorks' => ['required'],
        ]);

        $data = $request->all();

        $days = $data['daysWorks'];

        foreach($days as $key=>$day){
            $idDay = $day['idDay'];
            $dayActive = $day['active'];

            if($dayActive == false) continue;

            $openHoursDAO = new OpenHoursDAO();
            $daysHasUsersDAO = new DaysHasUsersDAO();

            $hoursDados = [
                'open' => $day['open'],
                'close' => $day['endService'],
                'lunch_time_out' => $day['stopLaunch'],
                'lunch_time_in' => $day['backLaunch']
            ];

            $queryOpen = $openHoursDAO->verifyHours($hoursDados);

            if($queryOpen){
                $queryHours = $openHoursDAO->createOpenHours($hoursDados);
                $idOpenHours = $queryHours->id;
            }else $idOpenHours = $queryOpen->id_opening_hour;

            $dayDados = [
                'users_id_user' => $idUser,
                'days_weeks_id_days_week' => $idDay,
                'opening_hours_id_opening_hour' => $idOpenHours,
            ];

            $queryDaysHours = $daysHasUsersDAO->createDaysWeeksHasUsers($dayDados);
        }
    }

}
