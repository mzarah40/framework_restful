<?php  

namespace App\Helper;

class SessionInitHelper
{
	public static function run()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
	}
}