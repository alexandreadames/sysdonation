<?php

namespace App\Models\Utils;

use \Firebase\JWT\JWT;

use \Psr\Http\Message\ServerRequestInterface as Request;


Class TokenUtils {

    const TOKEN_EXPIRATION_TIME = "+1 hour";
    const TOKEN_HEADER = "Authorization";

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

    public static function decodeToken(Request $request){

    	$token = $request->getHeader('Authorization');

        $splited_token = explode(" ", $token[0]);
        
        //Decrypt token
        $decoded = JWT::decode($splited_token[1], Globals::SECRET_KEY, array('HS256'));

        return (array) $decoded;
    }
}

?>