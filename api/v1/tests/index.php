<?php

/**
 * AutoLoad do Composer
 */
require_once("../vendor/autoload.php");

use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use \Firebase\JWT\SignatureInvalidException;


const SECRET_KEY = "secret@sysdonation";

$date = new DateTime();
$date->modify("+2 minutes");

$token = array(
	"userId"=> 6,
	"exp"=> $date->getTimestamp()
);

//$jwt = JWT::encode($token, SECRET_KEY);

//echo $jwt;
try{

	$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjYsImV4cCI6MTUyOTI4MTUxMX0.JpTIqNXGmRTCFMr1b_wtkguTeeqCRjx02TQBUfh9EaQ";

	$decoded = JWT::decode($jwt, SECRET_KEY, array('HS256'));

	var_dump($decoded);

}
catch (ExpiredException $ee) {

	echo "O Token expirou, refaça seu login";

}
catch (SignatureInvalidException $sie) {

	echo "Não foi possível verificar a integridade do token, be carefull";

}




/*$arraytest = array(
	"id" => 1,
	"name"=> "Alexandre",
	"email"=> "alexandre.adames@gmail.com",
	"idpessoa"=> 6,
	"password"=> "%$%#%$#12345"
);

unset($arraytest["id"], $arraytest["idpessoa"], $arraytest["password"] );

print_r($arraytest);*/




?>