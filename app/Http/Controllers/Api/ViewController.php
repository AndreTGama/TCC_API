<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\DaysHasUsersDAO;
use App\DAO\UsersDAO;
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
        $data = $this->validate($request, [
            'idUser' => ['required'],
        ]);

        $data = $request->all();
        $idUser = $data['idUser'];

        $usersDao = new UsersDAO();

        $infoUser = $usersDao->infoUser($idUser);

        if($infoUser) return ReturnMessage::messageReturn(false,null,null,null, $infoUser);

        return ReturnMessage::messageReturn(false,null,null,null, null);
    }
     /**
     * viewHoursCompany
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function viewHoursCompany(Request $request)
    {
        $data = $this->validate($request, [
            'idUser' => ['required', 'integer'],
        ]);

        $data = $request->all();
        $idUser = $data['idUser'];

        $daysHasUsersDAO = new DaysHasUsersDAO();

        $hoursCompany = $daysHasUsersDAO->viewHoursCompany($idUser);

        if(empty($hoursCompany)) return ReturnMessage::messageReturn(true,'Usuário não tem horas',null,null, $hoursCompany);

        return ReturnMessage::messageReturn(false,null,null,null, $hoursCompany);
    }
}
