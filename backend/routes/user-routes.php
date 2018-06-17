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


/**
 * Pega os dados do usuário após logar
 */
$app->get('/secure/user', function (Request $request, Response $response) use ($app) {
    
    //$route = $request->getAttribute('route');
    //$id = $route->getArgument('id');    
    
    $token = $request->getHeader('X-Token');

    //Decrypt token
    $decoded = JWT::decode($token[0], Globals::SECRET_KEY, array('HS256'));
    
    //$user = json_decode($decoded, true);

    //$userDAO = new UserDAO();

    //$result = $userDAO->getUserById($user["id"]);

    $return = $response->withJson($decoded, 200)
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