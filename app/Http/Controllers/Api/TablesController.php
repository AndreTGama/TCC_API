<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\TypesServicesDAO;
use App\DAO\UsersDAO;
use App\Http\Controllers\Controller;
use App\Model\days_week;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * listTypeServices
     *
     * @return void
     */
    public function listTypeServices()
    {
        $typesServicesDAO = new TypesServicesDAO();

        $queryListTypesServices = $typesServicesDAO->listTypeUsers();
        return ReturnMessage::messageReturn(false,null,null,null, $queryListTypesServices);
    }
    /**
     * listDaysWeeks
     *
     * @return void
     */
    public function listDaysWeeks()
    {
        $listDaysWeeks = days_week::all();
        return ReturnMessage::messageReturn(false,null,null,null, $listDaysWeeks);
    }
    /**
     * listCompanys
     *
     * @return void
     */
    public function listCompanys()
    {
        $usersDAO = new UsersDAO();

        $listCompany = $usersDAO->listUsersInSystemForType(2);
        return ReturnMessage::messageReturn(false,null,null,null, $listCompany);
    }
    public function listClients()
    {
        $usersDAO = new UsersDAO();

        $listCompany = $usersDAO->listUsersInSystemForType(3);
        return ReturnMessage::messageReturn(false,null,null,null, $listCompany);
    }
}
