<?php

/**
 * AutoLoad do Composer
 */
require_once("vendor/autoload.php");

use \Firebase\JWT\JWT;

const SECRET_KEY = "secret@sysdonation";

$token = array(
	"login" => "alexandreadames",
	"email" => "alexandre.adames@gmail.com",
	"id"=> 1234
);

//$jwt = JWT::encode($token, SECRET_KEY);

//echo $jwt;

$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6ImFsZXhhbmRyZWFkYW1lcyIsImR0cmVnaXN0ZXIiOiIyMDE4LTA2LTE1IDE0OjM3OjMwIiwibmFtZSI6IkFsZXhhbmRyZSBcdTAwYzFkYW1lcyBBbHZlcyBQb250ZXMiLCJlbWFpbCI6ImFsZXhhbmRyZS5hZGFtZXNAZ21haWwuY29tIiwicGhvbmUiOiIoODQpIDk4ODI4LTUxMTYiLCJzaXRlIjoiaHR0cDpcL1wvd3d3Lmx1bHV6aW5oYWJhYnlraWRzLmNvbSIsImFkZHJlc3MiOiJBdi4gQnJpZ2FkZWlybyBTYWxlbWEiLCJjcGYiOiIwNDk4Mzg2MzQxOSJ9.vAWp4m3yLPYHgbohyuyA6XkE14uheZ7MlGNpurXtfAw";

$decoded = JWT::decode($jwt, SECRET_KEY, array('HS256'));

print_r($decoded);

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