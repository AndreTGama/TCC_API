<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Validation\ValidationException;
use App\Builder\ReturnMessage;

class ExceptionMiddleware
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
        $response = $next($request);

        if(empty($response->exception)) return $response;

        /** @var \Exception $exception */
        $exception = $response->exception;

        if($exception instanceof ValidationException) {
            return ReturnMessage::messageReturn(
                true,
                'Os dados enviados são inválidos',
                'Os dados enviados são inválidos',
                $exception,
                null
            );
        }
        else if(
            $exception instanceof SignatureInvalidException ||
            $exception instanceof ExpiredException ||
            $exception instanceof BeforeValidException ||
            $exception instanceof \UnexpectedValueException
        ) {
            return ReturnMessage::messageReturn(
                true,
                'Houve um erro no sistema de autenticação, por favor tente novamente, caso o erro persista entre em contato com o administrador do sistema.',
                $exception->getMessage(),
                $exception,
                null
            );
        }
        else if($exception instanceof UnauthorizedException) {
            return ReturnMessage::messageReturn(
                true,
                'Você não tem acesso a esse endpoint da API.',
                'Você não tem acesso a essa área do sistema.',
                $exception,
                null
            );
        }
        else if(
            $exception instanceof \Exception ||
            $exception instanceof \Throwable
        ) {
            return ReturnMessage::messageReturn(
                true,
                'Erro desconhecido.',
                'Houve um erro no sistema, tente novamente ou entre em contato com o administrador do sistema.',
                $exception,
                null
            );
        }
        return $response;
    }
}
