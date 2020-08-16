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
        try {
			$tokenDecode = JWT::decode($request->bearerToken(), env('JWT_SECRET'),['HS256']);
			Token::setTokenEncode($request->bearerToken());
			Token::setTokenDecode($tokenDecode);
		} catch (SignatureInvalidException | ExpiredException | BeforeValidException| \UnexpectedValueException $error) {
            return ReturnMessage::messageReturn(false,'Houve um erro na autenticação, por favor tente novamente. Caso o erro persista, entre em contato com o administrador do sistema',$error->getMessage(),null, null);
		}
        return $next($request);
    }
}
