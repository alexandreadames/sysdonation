<?php

/**
 * Entities
 */
use \App\Models\Utils\Globals;


/*
*=============================================================================================
* BEGIN - CONFIGS
*=============================================================================================
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
$container['secretkey'] = Globals::SECRET_KEY;

/*
*=============================================================================================
* END -CONFIGS
*=============================================================================================
*/

 /**
 * Application Instance
 */
$app = new \Slim\App($container);


/*
*=============================================================================================
* ENABLE CORS - DEV...
*=============================================================================================
*/

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


/**
 * Auth básica do JWT
 * Whitelist - Bloqueia tudo, e só libera os
 * itens dentro do "passthrough"
 */
$app->add(new Tuupola\Middleware\JwtAuthentication([
    //"regexp" => "/(.*)/",
    //"header" => "X-Token",
    "path" => "/secure",
    "realm" => "Protected",
    "secret" => $container['secretkey'],
    "error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments;
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
            //->withJson($data, 401);
    }
]));


?>