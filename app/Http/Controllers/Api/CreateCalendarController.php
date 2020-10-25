<?php

namespace App\Http\Controllers\Api;

use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateCalendarController extends Controller
{
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
        $hour = $data['hour'];
        $idServicesCompany = $data['idServicesCompany'];

        
    }
}
