<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;


/**
 * Entities
 */
use \App\Models\Entity\User;
use \App\Models\DAO\UserDAO;
use \App\Models\Utils\Globals;


use \App\Models\Utils\TokenUtils;


/**
 * Pega os dados do usuário após logar
 */
$app->get('/secure/user', function (Request $request, Response $response) use ($app) {

        //$route = $request->getAttribute('route');
        //$id = $route->getArgument('id'); 

        $decoded_token = TokenUtils::decodeToken($request);   

        $userDAO = new UserDAO();

        $result = $userDAO->getUserById( (int) $decoded_token["userId"]);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

/**
 * Pega os dados completos do usuário
 */
$app->get('/secure/user-personaldata-profile', function (Request $request, Response $response) use ($app) { 

        $decoded_token = TokenUtils::decodeToken($request);   

        $userDAO = new UserDAO();

        $result = $userDAO->getPersonalDataAndProfile( (int) $decoded_token["userId"]);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

/**
 * Cadastra um novo usuário
 */
$app->post('/user/register', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $user = new User();

    $user->setName($params->name);
    $user->setEmail($params->email);
    $user->setPhone($params->phone);
    $user->setSite($params->site);
    $user->setAddress($params->address);
    $user->setCPF($params->cpf);
    $user->setLogin($params->login);
    $user->setPassword($params->password);

    $userDAO = new UserDAO();

    $result = $userDAO->register($user);
    
    $return = $response->withJson($result, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});


/**
 * Login
 */

$app->post('/user/login', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $userDAO = new UserDAO();

    $result = $userDAO->login($params->login, $params->password );
    
    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json; charset=utf-8');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});
?>