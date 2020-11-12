<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\CalendarDAO;
use App\DAO\ContactsDAO;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

class ViewCalendarController extends Controller
{
   /**
    * listCalendarCompany
    *
    * @return void
    */
   public function listCalendarCompany()
   {
        $idUser = Token::getTokenDecode()->sub;
        $calendarDAO = new CalendarDAO();
        $contactsDAO = new ContactsDAO();

        $listCalendarEvents = $calendarDAO->listCalendarCompany($idUser);

        if(empty($listCalendarEvents)) return ReturnMessage::messageReturn(true,'Não tem nada na agenda',null,null, null);

        foreach($listCalendarEvents as $key=>$service) {
            $idCompany = $service->id_user;
            $listContact = $contactsDAO->listContactUser($idCompany);
            $listCalendarEvents[$key]->contacts = $listContact;
        }


        return ReturnMessage::messageReturn(false,null,null,null, $listCalendarEvents);
    }
    /**
     * listCalendarClient
     *
     * @return void
     */
    public function listCalendarClient()
    {
        $idUser = Token::getTokenDecode()->sub;
        $calendarDAO = new CalendarDAO();
        $contactsDAO = new ContactsDAO();

        $listCalendarEvents = $calendarDAO->verifyCalendarUserById($idUser);

        if(empty($listCalendarEvents)) return ReturnMessage::messageReturn(true,'Não tem nada na agenda',null,null, null);

        foreach($listCalendarEvents as $key=>$service) {
            $idCompany = $service->id_user;
            $startDayService = $service->day_commitment;
            $startHourService = $service->hour_commitment;
            $timeCalendar = $service->time;
            $timeArray = explode(":", $timeCalendar);
                $hoursCalendar = $timeArray['0'];
                $minutesCalendar = $timeArray['1'];
                $secondsCalendar = $timeArray['2'];
            $startService = "$startDayService $startHourService";
            $newDate = date("m/d/Y h:i:s a", strtotime($startService));
            $dateCalendar = new DateTime($newDate);
            $dateCalendar->modify("+ $hoursCalendar hours");
            $dateCalendar->modify("+ $minutesCalendar minutes");
            $dateCalendar->modify("+ $secondsCalendar seconds");
            $endService = $dateCalendar->format('m/d/Y h:i:s a');

            $listContact = $contactsDAO->listContactUser($idCompany);
            $listCalendarEvents[$key]->contacts = $listContact;
            $listCalendarEvents[$key]->start = $newDate;
            $listCalendarEvents[$key]->end = $endService;
        }
        return ReturnMessage::messageReturn(false,null,null,null, $listCalendarEvents);
    }
}
