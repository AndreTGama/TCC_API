<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\CalendarDAO;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'day' => ['required'],
            'hour' => ['required'],
            'idServicesCompany' => ['required']
        ]);

        $data = $request->all();

        $day = $data['day'];
        $note = $data['note'];
        $hour = $data['hour'];
        $idServicesCompany = $data['idServicesCompany'];

        $calendarDAO = new CalendarDAO();
        $servicesDAO = new ServicesDAO();

        $dateNew = date('Y-m-d', strtotime(str_replace('/', '-', $day)));

        $dataCalendar = [
            'day_commitment' => $dateNew,
            'hour_commitment' => $hour,
            'note' => $note,
            'services_companies_id_services_company' => $idServicesCompany,
            'users_id_user' => $idUser
        ];

        $verifyHasEvent = $calendarDAO->verifyCalendar($dataCalendar);

        if($verifyHasEvent) return ReturnMessage::messageReturn(true,'Você já tem esse compromisso marcado',null,null, null);

        $listCalendar = $calendarDAO->verifyCalendarUserById($idUser);

        $serviceView = $servicesDAO->viewServiceById($idServicesCompany);

        if(!$serviceView) return ReturnMessage::messageReturn(true,'Serviço não encontrado',null,null, null);

        $dateNewCalendar = new DateTime("$dateNew $hour");

        if(!empty($listCalendar)){
            foreach($listCalendar as $key=>$calendar){
                $dayCalendar = $calendar->day_commitment;
                $hourCalendar = $calendar->hour_commitment;
                $timeCalendar =  $calendar->time;
                $timeArray = explode(":", $timeCalendar);
                $hoursCalendar = $timeArray['0'];
                $minutesCalendar = $timeArray['1'];
                $secondsCalendar = $timeArray['2'];

                $dateCalendar = new DateTime("$dayCalendar $hourCalendar");
                $dateCalendar->modify("+ $hoursCalendar hours");
                $dateCalendar->modify("+ $minutesCalendar minutes");
                $dateCalendar->modify("+ $secondsCalendar seconds");

                if($dateNewCalendar == $dateCalendar) return ReturnMessage::messageReturn(true,'Você já tem compromisso nessa data',null,null, null);
            }
        }
        DB::beginTransaction();

        $calendar = $calendarDAO->createCalendar($dataCalendar);
        if(isset($calendar->id)) {
            DB::commit();
            return ReturnMessage::messageReturn(false,'Evento marcado no seu calendario',null,null, null);
        }
        DB::rollBack();
        return ReturnMessage::messageReturn(true,'Erro ao cadastrar evento',null,null, null);

    }
}
