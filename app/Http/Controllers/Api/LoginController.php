<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;

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
    public function loginUser(Request $request)
	{
		$data = $request->all();

		$dataExpira = new DateTime();

		$email = $data['login'];
		$senha = $data['password'];

		if (empty($email) || empty($senha))
			return response()->json(['message' => 'Campos vazios']);

		$user = $usuarioDAO->verificarUsuario($email,true);

		if(!$user)
			return response()->json(['message' => 'Usuário/Senha inválido']);

		$tipoUsuario = $tipoUsuarioDAO->consultarUsuarioHasTipoUsuario($user[0]->id_usuario);
		$senhaBD = $usuarioDAO->verificarSenha($email);

		if (!Hash::check($senha, $senhaBD[0]->senha))
			return response()->json(['message' => 'Usuário/Senha inválido']);

		$tokenUser = array(
			'uuid' => uniqid('ut') . $user[0]->id_usuario, //identificador unico
			'sub' => $user[0]->id_usuario,
			'tipo_usuario' => array_map(function($item) {
				return $item->tipo_usuario_id_tipo_usuario;
			}, $tipoUsuario)
		);
		$tokenJWT = JWT::encode(array_merge($tokenUser, ['exp' => $dataExpira->modify("+{$expiredAT} seconds")->getTimestamp(),]), env('APP_KEY'), 'HS256');
		$expiredAT += 604800;
		$refreshToken = JWT::encode(array_merge($tokenUser, ['exp' => $dataExpira->modify("+{$expiredAT} seconds")->getTimestamp(),]), env('APP_KEY'), 'HS256');

		$dadosToken = [
			'token' => $tokenJWT,
			'usuario_id_usuario' => $user[0]->id_usuario,
		];
		$tokenDAO->inserirToken($dadosToken);
		$idToken  = $tokenDAO->consultarIdToken($tokenJWT);

		$dadosRefreshToken = [
			'refresh_token' => $refreshToken,
			'token_id_token' => $idToken,
		];
		$refreshTokenDAO->inserirRefreshToken($dadosRefreshToken);

		$response = response()->json(['token' => $tokenJWT, 'refreshToken' => $refreshToken]);

		return $response;
	}
}
