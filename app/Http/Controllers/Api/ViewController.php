<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\UsersDAO;
use App\DAO\UsersHasComunicatedsDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * listSupervisorInSystem
     *
     * @return \Illuminate\Http\Response
     */
    public function listSupervisorInSystem()
    {
        $usersDAO = new UsersDAO();
        $typeUser = 1;

        $listAdmi = $usersDAO->listUsersInSystemForType($typeUser);

        return ReturnMessage::messageReturn(false,null,null,null, $listAdmi);
    }
    /**
     * listAdmInSystem
     *
     * @return \Illuminate\Http\Response
     */
    public function listAdmInSystem()
    {
        $usersDAO = new UsersDAO();
        $typeUser = 2;

        $listCompany = $usersDAO->listUsersInSystemForType($typeUser);

        return ReturnMessage::messageReturn(false,null,null,null, $listCompany);
    }
    /**
     * listClientInSystem
     *
     * @return \Illuminate\Http\Response
     */
    public function listClientInSystem()
    {
        $usersDAO = new UsersDAO();
        $typeUser = 3;

        $listClient = $usersDAO->listUsersInSystemForType($typeUser);

        return ReturnMessage::messageReturn(false,null,null,null, $listClient);
    }
    /**
     * viewOnlyUser
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function viewOnlyUser(Request $request)
    {
        $this->validate($request, [
            'idUser' => ['required'],
        ]);

        $data = $request->all();
        $idUser = $data['idUser'];

        $usersDao = new UsersDAO();

        $infoUser = $usersDao->infoUser($idUser);

        if($infoUser) return ReturnMessage::messageReturn(false,null,null,null, $infoUser);

        return ReturnMessage::messageReturn(false,null,null,null, null);
    }
    public function listComunicatedReceived(Request $request)
    {
        $idUser = Token::getTokenDecode()->sub;
        $usersHasComunicatedsDAO = new UsersHasComunicatedsDAO();
        $listComunicated = $usersHasComunicatedsDAO->listUsersComunicated($idUser);
        if(empty($listComunicated)) return ReturnMessage::messageReturn(false,'Não possui comunicado',null,null, $listComunicated);;
        return ReturnMessage::messageReturn(false,null,null,null,$listComunicated);

    }
    public function viewComunicated(Request $request)
    {
        $idUser = Token::getTokenDecode()->sub;
        $data = $this->validate($request, [
            'idUsersHasComunicated' => ['required']
        ]);
        $data = $request->all();
        $idUserHasComunicated = $data['idUsersHasComunicated'];
        $usersHasComunicatedsDAO = new UsersHasComunicatedsDAO();
        $viewComunicated = $usersHasComunicatedsDAO->viewUsersComunicated($idUserHasComunicated);
        if($viewComunicated) return ReturnMessage::messageReturn(false,null,null,null, $viewComunicated);;
        return ReturnMessage::messageReturn(true,'Comunicado não existe',null,null,null);
    }
}
