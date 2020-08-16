<?php

namespace App\Builder;

final class ReturnMessage
{

	public static function messageReturn(bool $error, ?string $message, ?string $developerMessage, ?\Throwable $exception, $data)
	{
		return response()->json([
			'error' => $error,
			'message' =>  $message,
			'developerMessage' => $developerMessage,
			'exception' => $exception,
			'data' => $data
		]);
	}
}
