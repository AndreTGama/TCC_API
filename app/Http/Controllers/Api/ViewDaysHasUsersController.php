<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\DaysHasUsersDAO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewDaysHasUsersController extends Controller
{
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
