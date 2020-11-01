<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\CalendarDAO;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
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

        $listCalendarEvents = $calendarDAO->listCalendarCompany($idUser);

        if(empty($listCalendarEvents)) return ReturnMessage::messageReturn(true,'Não tem nada na agenda',null,null, null);

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

        $listCalendarEvents = $calendarDAO->verifyCalendarUserById($idUser);

        if(empty($listCalendarEvents)) return ReturnMessage::messageReturn(true,'Não tem nada na agenda',null,null, null);

        return ReturnMessage::messageReturn(false,null,null,null, $listCalendarEvents);
    }
}
