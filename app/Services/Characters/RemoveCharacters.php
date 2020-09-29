<?php

namespace App\Services\Characters;

final class RemoveCharacters
{
	/**
	 * removeAllCharacters
	 *
	 * @param  string $valor
	 * @return string
	 */
    function removeAllCharacters($string) : string
    {
		$string = trim($string);
		$string = str_replace(".", "", $string);
		$string = str_replace(",", "", $string);
		$string = str_replace("-", "", $string);
		$string = str_replace("/", "", $string);
		return $string;
	}
}
