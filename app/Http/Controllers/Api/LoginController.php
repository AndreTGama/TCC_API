<?php

namespace App\Http\Controllers\Api;

use App\Builder\ReturnMessage;
use App\DAO\RefreshTokenDAO;
use App\DAO\TokenDAO;
use App\DAO\UsersDAO;
use App\Http\Controllers\Controller;
use DateTime;
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
        $tokenDAO = new TokenDAO();
        $refreshTokenDAO = new RefreshTokenDAO();
        $tokenDAO = new TokenDAO();
        $dateExpire = new DateTime();


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

        $user = $usersDAO->verifyLogin($login,true);

        if(!$user) return ReturnMessage::messageReturn(true,'Usuário/Senha inválido',null,null, null);

		$passwordBD = $user->password;

		if (!Hash::check($password, $passwordBD))
            return ReturnMessage::messageReturn(true,'Usuário/Senha inválido',null,null, null);

        $idUser = $user->id_user;

		$tokenUser = array(
			'uuid' => uniqid('ut') . $idUser,
            'sub' => $idUser,
            'name' => $user->name_user,
			'tipo_usuario' => $user->type_users_id_type_user
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
    public function logoutUser()
    {

    }
}
