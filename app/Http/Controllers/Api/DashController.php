<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\FunctionsDAO;
use App\DAO\TypeUsersDAO;
use App\DAO\UsersDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashController extends Controller
{
    /**
     * dashSupervisor
     *
     * @return void
     */
    public function dashSupervisor()
    {
        $functions = Token::getTokenDecode()->functions;
        $arrayFuntionsId = [];
        $arrayTypeFuntions = [];

        foreach($functions as $function){
            $arrayFuntionsId[] = $function->id_function;
        }

        if(!array_search(21, $arrayFuntionsId)) return ReturnMessage::messageReturn(true,'Usuário não tem permissão de acessar essa função',null,null, null);

        $usersDAO = new UsersDAO();
        $typeUsersDAO = new TypeUsersDAO();

        $listTypeUsers = $typeUsersDAO->listTypeUsers();

        foreach($listTypeUsers as $typeUser) {
            $typeUserName = $typeUser->type_user;
            $idTypeUser = $typeUser->id_type_user;

            $listUsersForType = $usersDAO->listUsersInSystemForType($idTypeUser);

            $count = count($listUsersForType);

            $arrayTypeFuntions[] = [
                $typeUserName => $count,
            ];
        }

        return ReturnMessage::messageReturn(false,null,null,null, $arrayTypeFuntions);
    }
}
