<?php
namespace App\DATA;

use App\Data\Interfaces\UsuarioToken;

final class Token{
	/**
	 * @var UsuarioToken
	 */
	public static $tokenDecode;
	/**
	 * @var string
	 */
	public static $tokenEncode;
	/**
	 * getTokenDecode
	 *
	 * @return UsuarioToken
	 */
	public static function getTokenDecode()
	{
		return self::$tokenDecode;
	}
	/**
	 * setTokenDecode
	 *
	 * @param UsuarioToken $tokenDecode
	 *
	 * @return void
	 */
	public static function setTokenDecode($tokenDecode): void
	{
		self::$tokenDecode = $tokenDecode;
	}

	/**
	 * Get the value of tokenEncode
	 *
	 * @return  string
	 */
	public static function getTokenEncode(): string
	{
		return self::$tokenEncode;
	}
	/**
	 * setTokenEncode
	 *
	 * @param string $tokenEncode
	 *
	 * @return void
	 */
	public static function setTokenEncode(string $tokenEncode): void
	{
		self::$tokenEncode = $tokenEncode;
	}
}
