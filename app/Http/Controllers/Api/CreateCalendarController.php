<?php

namespace App\Http\Controllers\Api;

use App\DAO\CalendarDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateCalendarController extends Controller
{
    /**
     * createCalendar
     *
     * @param  mixed $request
     * @return void
     */
    public function createCalendar(Request $request)
    {
        $idUser = Token::getTokenDecode()->sub;

        $data = $this->validate($request, [
            'day' => ['requiered'],
            'hour' => ['required'],
            'idServicesCompany' => ['required']
        ]);

        $data = $request->all();

        $day = $data['day'];
        $note = $data['note'];
        $hour = $data['hour'];
        $idServicesCompany = $data['idServicesCompany'];

        $calendarDAO = new CalendarDAO();

        $dataCalendar = [
            'day_commitment' => $day,
            'hour_commitment' => $hour,
            'note' => $note,
            'services_companies_id_services_company' => $idServicesCompany,
            'users_id_user' => $idUser
        ];

        $verifyHasEvent = $calendarDAO->verifyCalendar($dataCalendar);

        dd($verifyHasEvent);
    }
}
