<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\ComunicatedDAO;
use App\DAO\UsersHasComunicatedsDAO;
use App\DATA\Token;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateCommunicatedController extends Controller
{
    /**
     * createdComunicated
     *
     * @param  mixed $request
     * @return void
     */
    public function createdComunicated(Request $request)
    {
        $idUser = Token::getTokenDecode()->sub;
        $data = $this->validate($request, [
            'comunicated'=> ['required'],
            'toIdUser'=>['required','integer']
        ]);
        $data = $request->all();
        $comunicated = $data['comunicated'];
        $toIdUser = $data['toIdUser'];
        $comunicatedDAO = new ComunicatedDAO();
        $dados = ['comunicated' => $comunicated,'users_id_user'=> $idUser];

        DB::beginTransaction();

        $queryComunicated = $comunicatedDAO->createComunicated($dados);
        if(!isset($queryComunicated->id)) {
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Mensagem não foi enviada',null,null, null);
        }
        $usersHasComunicatedsDAO = new UsersHasComunicatedsDAO();
        $idComunicated = $queryComunicated->id;
        $dados =['users_id_user' => $toIdUser, 'comunicateds_id_comunicated'=> $idComunicated];
        $comunicatedHasUser = $usersHasComunicatedsDAO->createUsersComunicated($dados);
        if(!isset($comunicatedHasUser->id)) {
            DB::rollBack();
            return ReturnMessage::messageReturn(true,'Mensagem não foi enviada',null,null, null);
        }
        DB::commit();
        return ReturnMessage::messageReturn(false,'Mensagem foi enviada',null,null, null);
    }
}
