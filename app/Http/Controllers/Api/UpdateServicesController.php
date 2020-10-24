<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateServicesController extends Controller
{
    /**
     * updateServices
     *
     * @param  mixed $request
     * @return void
     */
    public function updateServices(Request $request)
    {
        $functions = Token::getTokenDecode()->functions;
        $idUser = Token::getTokenDecode()->sub;
        $serviceDAO = new ServicesDAO();
        $arrayFuntionsId = [];

        foreach($functions as $function){
            $arrayFuntionsId[] = $function->id_function;
        }

        $data = $this->validate($request, [
            'idService' => ['required', 'integer'],
            'price' => ['required'],
            'time' => ['required'],
            'service' => ['required'],
            'description' => ['required'],
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $idService = $data['idService'];
        $data['users_id_user'] = $idUser;

        $data = [
            'price' => $data['price'],
            'time' => $data['time'],
            'service' => $data['service'],
            'description' => $data['description'],
        ];

        $querySevices = $serviceDAO->consultServices(['id_services_company' => $idService]);

        if($querySevices){
            $querySevices = $serviceDAO->updateServices($idService, $data);
            DB::commit();
            return ReturnMessage::messageReturn(true,'Serviço atualizado',null,null, null);
        }
        DB::rollBack();
        return ReturnMessage::messageReturn(true,'Serviço não foi encontrado',null,null, null);
    }
}
