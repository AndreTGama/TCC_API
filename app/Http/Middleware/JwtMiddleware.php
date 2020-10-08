<?php

namespace App\Http\Middleware;

use App\Builder\ReturnMessage;
use Closure;
use App\Data\Token;
use Firebase\JWT\{JWT, BeforeValidException, SignatureInvalidException, ExpiredException};

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt = $request->bearerToken();
        $key = env('APP_KEY');

        try {
            $tokenDecode = JWT::decode($jwt, $key, array('HS256'));
			Token::setTokenEncode($jwt);
			Token::setTokenDecode($tokenDecode);
		} catch (SignatureInvalidException | ExpiredException | BeforeValidException| \UnexpectedValueException $error) {
            return ReturnMessage::messageReturn(false,'Houve um erro na autenticação, por favor tente novamente. Caso o erro persista, entre em contato com o administrador do sistema',$error->getMessage(),null, null);
		}
        return $next($request);
    }
}
