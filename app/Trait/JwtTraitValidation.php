<?php   

namespace App\Trait;

use App\Jwt\JwtVerify;
use App\Jwt\JwtResponseHttp;

trait JwtTraitValidation
{
	
	public static function JwtValidate()
	{
		$authorization = getallheaders();
		$authorization = $authorization['Authorization'];

		$verify = JwtVerify::verify($authorization);

		if (!$verify) {
			echo JwtResponseHttp::response(401);
			return false;
		}

		return true;
	}
}