<?php

namespace App\DAO;

use App\Model\users_has_comunicateds;
use App\Model\usershascomunicated;
use Illuminate\Support\Facades\DB;

class UsersHasComunicatedsDAO
{
    /**
     * createComunicated
     *
     * @param  array $dados
     * @return object
     */
    public function createUsersComunicated(array $dados) : object
    {
        $queryUsers_has_comunicated = users_has_comunicateds::create($dados);
        return $queryUsers_has_comunicated;
    }
    public function listUsersComunicated(int $idUser) : array
    {
        $queryView_Users_has_comunicated = DB::table('users_has_comunicateds')
                                                ->join('comunicateds','comunicateds.id_comunicated','users_has_comunicateds.comunicateds_id_comunicated')
                                                ->join('users','users.id_user','comunicateds.users_id_user')
                                                ->where('users.id_user',$idUser)
                                                ->select('users.id_user','users.name_user','comunicateds.*','users_has_comunicateds.id_users_has_comunicateds')->get()->toArray();
        return $queryView_Users_has_comunicated;
    }

    public function viewUsersComunicated(int $idUserComunicated) : ?object
    {
        $queryView_Users_has_comunicated = DB::table('users_has_comunicateds')
                                                ->join('comunicateds','comunicateds.id_comunicated','users_has_comunicateds.comunicateds_id_comunicated')
                                                ->join('users','users.id_user','comunicateds.users_id_user')
                                                ->where('users_has_comunicateds.id_users_has_comunicateds',$idUserComunicated)
                                                ->select('users.id_user','users.name_user','comunicateds.*','users_has_comunicateds.id_users_has_comunicateds')->get()->first();
        return $queryView_Users_has_comunicated;
    }

}
