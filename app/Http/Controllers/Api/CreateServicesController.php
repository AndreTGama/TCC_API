<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateServicesController extends Controller
{
    /**
     * createServices
     *
     * @param  mixed $request
     * @return void
     */
    public function createServices(Request $request)
    {
        $functions = Token::getTokenDecode()->functions;
        $idUser = Token::getTokenDecode()->sub;
        $serviceDAO = new ServicesDAO();
        $arrayFuntionsId = [];

        foreach($functions as $function){
            $arrayFuntionsId[] = $function->id_function;
        }

        $data = $this->validate($request, [
            'price' => ['required'],
            'time' => ['required'],
            'service' => ['required'],
            'description' => ['required'],
            'types_services_id_type_service' => ['required', 'integer']
        ]);

        DB::beginTransaction();

        $data = $request->all();
        $data['users_id_user'] = $idUser;

        $querySevices = $serviceDAO->consultServices($data);

        if($querySevices){
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Serviço já foi cadastrado',null,null, null);
        }

        $querySevices = $serviceDAO->createServicesCompany($data);
        if(isset($querySevices->id)){
            DB::commit();
            return ReturnMessage::messageReturn(false,'Serviço cadastrado',null,null, null);
        }
        DB::rollBack();
        return ReturnMessage::messageReturn(true,'Erro ao cadastrar serviço',null,null, null);
    }
}
