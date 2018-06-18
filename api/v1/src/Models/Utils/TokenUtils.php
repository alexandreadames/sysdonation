<?php

namespace App\Models\Utils;

use \Firebase\JWT\JWT;


Class TokenUtils {

    const TOKEN_EXPIRATION_TIME = "+1 hour";

    public static function generateToken($custom_payload){

    	//O Token expira em 1 hora
		$date = new \DateTime();
		$date->modify(TokenUtils::TOKEN_EXPIRATION_TIME);


		$payload = array_merge(
			$custom_payload, 
			array(
				"exp" => $date->getTimestamp()
			)
		);

		$jwt = JWT::encode($payload, Globals::SECRET_KEY);

		return $jwt;

    }
}

?>