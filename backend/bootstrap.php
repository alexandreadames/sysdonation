<?php

require './vendor/autoload.php';

use Firebase\JWT\JWT;
//use Psr7Middlewares\Middleware\TrailingSlash;


/**
 * Configurações
 */
$configs = [
    'settings' => [
        'displayErrorDetails' => true,
    ]   
];

/**
 * Container Resources do Slim.
 * Aqui dentro dele vamos carregar todas as dependências
 * da nossa aplicação que vão ser consumidas durante a execução
 * da nossa API
 */
$container = new \Slim\Container($configs);

/**
 * Token do nosso JWT
 */
$container['secretkey'] = "secret@sysdonation";

/**
 * Application Instance
 */
$app = new \Slim\App($container);


/**
 * @Middleware Tratamento da / do Request 
 * true - Adiciona a / no final da URL
 * false - Remove a / no final da URL
 */
//$app->add(new TrailingSlash(false));

/**
 * Auth básica do JWT
 * Whitelist - Bloqueia tudo, e só libera os
 * itens dentro do "passthrough"
 */
/*$app->add(new Tuupola\Middleware\JwtAuthentication([
    "regexp" => "/(.*)/",
    "header" => "X-Token",
    "path" => "/",
    "passthrough" => ["/login", "/register"],
    "realm" => "Protected",
    "secret" => $container['secretkey']
]));*/

?>


