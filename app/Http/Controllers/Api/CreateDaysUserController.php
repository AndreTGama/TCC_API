<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\DaysHasUsersDAO;
use App\DAO\OpenHoursDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateDaysUserController extends Controller
{
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
        $daysHasUsersDAO = new DaysHasUsersDAO();
        $openHoursDAO = new OpenHoursDAO();
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
        $filterConsultDays = [
            'idUser' => $idUser
        ];

        $queryExistDaysHasUsers = $daysHasUsersDAO->consultDaysWeeksHasUsers($filterConsultDays);

        DB::beginTransaction();
        if(!empty($queryExistDaysHasUsers)){

            foreach($queryExistDaysHasUsers as $key=>$dayUser){
                $idDaysWeeks = $dayUser->id_days_weeks_has_users;
                $idDayHasUser = $dayUser->id_days_week;

                foreach($days as $key=>$day){

                    $idDay = $day['idDay'];
                    $dayActive = $day['active'];

                    $hoursDados = [
                        'open' => $day['open'].":00",
                        'close' => $day['endService'].":00",
                        'lunch_time_out' => $day['stopLaunch'].":00",
                        'lunch_time_in' => $day['backLaunch'].":00"
                    ];

                    $queryOpen = $openHoursDAO->verifyHours($hoursDados);

                    if(!$queryOpen){
                        $queryHours = $openHoursDAO->createOpenHours($hoursDados);
                        $idOpenHours = $queryHours->id;
                    }else $idOpenHours = $queryOpen->id_opening_hour;

                    $dayDados = [
                        'users_id_user' => $idUser,
                        'days_weeks_id_days_week' => $idDay,
                        'opening_hours_id_opening_hour' => $idOpenHours,
                        'active' => $dayActive,
                    ];
                    if($idDayHasUser == $idDay)
                        $daysHasUsersDAO->updateDaysHoursCompany($idDaysWeeks, $dayDados);
                }
            }
        }else {
            foreach($days as $key=>$day){
                $idDay = $day['idDay'];
                $dayActive = $day['active'];

                $hoursDados = [
                    'open' => $day['open'].":00",
                    'close' => $day['endService'].":00",
                    'lunch_time_out' => $day['stopLaunch'].":00",
                    'lunch_time_in' => $day['backLaunch'].":00"
                ];

                $queryOpen = $openHoursDAO->verifyHours($hoursDados);

                if(!$queryOpen){
                    $queryHours = $openHoursDAO->createOpenHours($hoursDados);
                    $idOpenHours = $queryHours->id;
                }else $idOpenHours = $queryOpen->id_opening_hour;

                $dayDados = [
                    'users_id_user' => $idUser,
                    'days_weeks_id_days_week' => $idDay,
                    'opening_hours_id_opening_hour' => $idOpenHours,
                    'active' => $dayActive,
                ];

                $daysHasUsersDAO->createDaysWeeksHasUsers($dayDados);
            }
        }

        DB::commit();
        return ReturnMessage::messageReturn(false,'Registro de horas feito com sucesso',null,null, null);
    }
}
