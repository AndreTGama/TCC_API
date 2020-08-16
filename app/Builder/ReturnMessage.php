<?php

namespace App\Builder;

final class ReturnMessage
{
	/**
	 * messageReturn
	 *
	 * @param  bool $error
	 * @param  string $message
	 * @param  string $developerMessage
	 * @param  mixed $exception
	 * @param  mixed $data
	 * @return void
	 */
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
