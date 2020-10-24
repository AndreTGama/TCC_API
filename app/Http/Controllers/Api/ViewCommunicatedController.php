<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\UsersHasComunicatedsDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewCommunicatedController extends Controller
{
    /**
     * listComunicatedReceived
     *
     * @return void
     */
    public function listComunicatedReceived()
    {
        $idUser = Token::getTokenDecode()->sub;
        $usersHasComunicatedsDAO = new UsersHasComunicatedsDAO();
        $listComunicated = $usersHasComunicatedsDAO->listUsersComunicated($idUser);
        if(empty($listComunicated)) return ReturnMessage::messageReturn(false,'Não possui comunicado',null,null, $listComunicated);;
        return ReturnMessage::messageReturn(false,null,null,null,$listComunicated);

    }
    /**
     * viewComunicated
     *
     * @param  mixed $request
     * @return void
     */
    public function viewComunicated(Request $request)
    {
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
