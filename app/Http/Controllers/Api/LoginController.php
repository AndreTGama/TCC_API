<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\FunctionHasUserDAO;
use App\DAO\RefreshTokenDAO;
use App\DAO\TokenDAO;
use App\DAO\UsersDAO;
use App\DATA\Token;
use App\DAO\VerifyCodeDAO;
use App\Http\Controllers\Controller;
use App\Mail\EmailServices;
use DateTime;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * loginUser
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $usersDAO = new UsersDAO();
        $tokenDAO = new TokenDAO();
        $refreshTokenDAO = new RefreshTokenDAO();
        $tokenDAO = new TokenDAO();
        $dateExpire = new DateTime();
        $functionHasUserDAO = new FunctionHasUserDAO();

        $data = $this->validate($request, [
            'login' => ['required'],
            'password' => ['required']
        ]);

        $data = $request->all();

        $login = $data['login'];
        $password = $data['password'];
        $expiredAT = $data['time_to_expire'] ?? 604800;

        if (empty($login) || empty($password))
            return ReturnMessage::messageReturn(true,'Campos vazios',null,null, null);

        $user = $usersDAO->verifyLogin($login, true);

        if (!$user) return ReturnMessage::messageReturn(true, 'Usuário não existe', null, null, null);

        if ($user->active == false) return ReturnMessage::messageReturn(true, 'Usuário não está ativo no sistema', null, null, null);

        $passwordBD = $user->password;

        if (!Hash::check($password, $passwordBD))
            return ReturnMessage::messageReturn(true, 'Usuário/Senha inválido', null, null, null);

        $idUser = $user->id_user;

        $functionUser = $functionHasUserDAO->verifyFunctions($user->type_users_id_type_user);

		$tokenUser = array(
			'uuid' => uniqid('ut') . $idUser,
            'sub' => $idUser,
            'name' => $user->name_user,
            'type_user' => $user->type_users_id_type_user,
            'functions' => $functionUser,
        );

        $tokenJWT = JWT::encode(array_merge($tokenUser, ['exp' => $dateExpire->modify("+{$expiredAT} seconds")->getTimestamp(),]), env('APP_KEY'), 'HS256');
        $expiredAT += 604800;
		$refreshToken = JWT::encode(array_merge($tokenUser, ['exp' => $dateExpire->modify("+{$expiredAT} seconds")->getTimestamp(),]), env('APP_KEY'), 'HS256');

        $dadosToken = [
			'token' => $tokenJWT,
			'users_id_user' => $idUser,
        ];

        $queryIdToken = $tokenDAO->createToken($dadosToken);

		$dadosRefreshToken = [
			'refresh_token' => $refreshToken,
			'tokens_id_token' => $queryIdToken->id,
        ];

        $refreshTokenDAO->createToken($dadosRefreshToken);

        return ReturnMessage::messageReturn(false,null,null,null, $tokenJWT);
    }
    /**
     * logoutUser
     *
     * @return void
     */
    public function logoutUser()
    {
        $userId = Token::getTokenDecode()->sub;
		$tokeDAO = new TokenDAO();

		$tokeDAO->deleteToken($userId);

        return ReturnMessage::messageReturn(false,'Usuário deslogado',null,null, null);
    }
    /**
     * forgotPassword
     *
     * @param  mixed $request
     * @return void
     */
    public function forgotPassword(Request $request)
    {
        $mail = new EmailServices();
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
        $dadosEmail=[
            'subject'=>'esqueceu-senha',
            'name'=>$nameUser,
            'email'=>$email,
            'code'=>$codigoConfirmacao
        ];
        $mail->sendEmailRecovery($dadosEmail);
        return ReturnMessage::messageReturn(false,'Código de verficação enviado para o e-mail',null,null, null);

    }
    /**
     * VerifyCode
     *
     * @param  mixed $request
     * @return void
     */
    public function VerifyCode(Request $request)
    {
        $data = $this->validate($request, [
            'code' => ['required'],
        ]);
        $data = $request->all();
        $code = $data['code'];
        $verifyCodeDAO = new VerifyCodeDAO();
        $dados = ['code' => $code];
        $queryCode = $verifyCodeDAO->consultCode($dados);


        if(!$queryCode)return ReturnMessage::messageReturn(true,'Código digitado é inválido',null,null,null);
        $idUser = $queryCode->users_id_user;
        return ReturnMessage::messageReturn(false,'Código digitado é válido',null,null,$idUser);
    }
    /**
     * ChangePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function ChangePassword(Request $request)
    {

       $data = $this->validate($request, [
            'password' => ['required'],
            'confirmedPassword' => ['required'],
            'idUser' => ['required','integer']
        ]);

        $data = $request->all();
        $password = $data['password'];
        $confirmedPassword = $data['confirmedPassword'];
        $idUser = $data['idUser'];
        if($password != $confirmedPassword) return ReturnMessage::messageReturn(true,'senhas não são iguais',null,null,null);
        $usersDao = new UsersDAO();
        $dados = ['password' => bcrypt($password)];
        $usersDao->updateUser($idUser,$dados);
        return ReturnMessage::messageReturn(false,'Senha alterada com sucesso',null,null,null);
    }
}
