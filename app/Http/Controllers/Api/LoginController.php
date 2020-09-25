<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\UsersDAO;
use App\DAO\VerifyCodeDAO;
use App\Http\Controllers\Controller;
use DateTime;
use Facade\Ignition\QueryRecorder\Query;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    /**
     * loginUser
     *
     * @param  mixed $request
     * @return void
     */
    public function loginUser(Request $request)
    {
        $usersDAO = new UsersDAO();
        $dateExpire = new DateTime();

        $data = $this->validate($request, [
            'login' => ['required'],
            'password' => ['required']
        ]);


        $data = $request->all();

        $login = $data['login'];
        $password = $data['password'];

        if (empty($login) || empty($password)) return ReturnMessage::messageReturn(true, 'Campos vazios', null, null, null);

        $user = $usersDAO->verifyLogin($login, true);

        if (!$user) return ReturnMessage::messageReturn(true, 'Usuário/Senha inválido', null, null, null);

        $passwordBD = $user->password;

        if (!Hash::check($password, $passwordBD))
            return ReturnMessage::messageReturn(true, 'Usuário/Senha inválido', null, null, null);

        $tokenUser = array(
            'uuid' => uniqid('ut') . $user->id_user,
            'sub' => $user->id_user,
            'name' => $user->name_user,
            'tipo_usuario' => $user->type_users_id_type_user
        );

        $expiredAT = 604800;
        $tokenJWT = JWT::encode(array_merge($tokenUser, ['exp' => $dateExpire->modify("+{$expiredAT} seconds")->getTimestamp(),]), env('JWT_SECRET'), 'HS256');

        return ReturnMessage::messageReturn(false, null, null, null, $tokenJWT);
    }
    public function forgotPassword(Request $request)
    {
        $data = $this->validate($request, [
            'email' => ['required'],
        ]);
        $data = $request->all();
        $email = $data['email'];
        $usersDAO = new UsersDAO();
        $verifyCodeDAO = new VerifyCodeDAO();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $dadosLogin = [
            'e-mail' => $email
        ];
        $userExist = $usersDAO->consultUser($dadosLogin);

        if(!$userExist) return ReturnMessage::messageReturn(true,'Usuário não existe','Login inserido não consta no banco de dados',null, null);

        $idUser=$userExist->id_user;
        $nameUser=$userExist->name_user;
        $codigoConfirmacao = substr(str_shuffle($characters),0,5);
        $dadosCode = [
            'code'=> $codigoConfirmacao,
            'users_id_user'=>$idUser
        ];
        $verifyCodeDAO->createVerifyCode($dadosCode);
        return ReturnMessage::messageReturn(false,'Código de verficação enviado para o e-mail',null,null, null);

    }
    public function verifyCode(Request $request) {

    }

    public function changePassword(Request $request) {

    }
}
