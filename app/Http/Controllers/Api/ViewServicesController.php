<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\ContactsDAO;
use App\DAO\ServicesDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewServicesController extends Controller
{
    /**
     * listServicesCompany
     *
     * @param  mixed $request
     * @return void
     */
    public function listServicesCompany(Request $request)
    {
        $idUser = Token::getTokenDecode()->sub;
        $servicesDAO = new ServicesDAO();

        $data = $request->all();

        $data['usersId'] = $idUser;
        $listServices = $servicesDAO->listOfServiceOfferedByCompany($data);

        if(empty($listServices)) return ReturnMessage::messageReturn(true,'Você não tem serviços criados',null,null, null);
        return ReturnMessage::messageReturn(false,null,null,null, $listServices);

    }
    /**
     * listServicesClient
     *
     * @param  mixed $request
     * @return void
     */
    public function listServicesClient(Request $request)
    {
        $servicesDAO = new ServicesDAO();

        $data = $request->all();

        $listServices = $servicesDAO->listOfServiceOfferedToCustomers($data);

        if(empty($listServices)) return ReturnMessage::messageReturn(true,'Não há datas para serem marcadas.',null,null, null);

        $contactsDAO = new ContactsDAO();

        foreach($listServices as $key=>$service) {
            $idCompany = $service->id_user;
            $listContact = $contactsDAO->listContactUser($idCompany);
            $listServices[$key]->contacts = $listContact;
        }

        return ReturnMessage::messageReturn(false,null,null,null, $listServices);

    }
    /**
     * viewServiceById
     *
     * @param  mixed $request
     * @return void
     */
    public function viewServiceById(Request $request)
    {
        $servicesDAO = new ServicesDAO();

        $data = $this->validate($request, [
            'idService' => ['required', 'integer'],
        ]);

        $data = $request->all();
        $idService = $data['idService'];

        $viewServices = $servicesDAO->viewServiceById($idService);

        if($viewServices) return ReturnMessage::messageReturn(false,null,null,null, $viewServices);
        return ReturnMessage::messageReturn(true,'Serviço não encontrado',null,null, null);
    }
}
