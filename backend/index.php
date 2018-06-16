<?php

/**
 * Load Vendors
 */
require './vendor/autoload.php';

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Firebase\JWT\JWT;

/**
 * Entities
 */
use \App\Models\Entity\Person;
use \App\Models\Entity\User;
use \App\Models\DAO\UserDAO;
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

/**
 * Auth básica do JWT
 * Whitelist - Bloqueia tudo, e só libera os
 * itens dentro do "passthrough"
 */
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "regexp" => "/(.*)/",
    "header" => "X-Token",
    "path" => "/secure",
    "realm" => "Protected",
    "secret" => $container['secretkey'],
    "error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = "Ocorreu um erro de autenticação";
        return $response
            ->withHeader("Content-Type", "application/json")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));

/*
*=============================================================================================
* ROUTES
*=============================================================================================
*/

/**
 * Lista de todos os livros
 */
$app->get('/', function (Request $request, Response $response) use ($app) {
   
   $response->getBody()->write("Bem-vindo ao Backend do Sysdonation!");
    return $response;
});

/**
 * Lista de todos os livros
 */
/*$app->get('/secure/person', function (Request $request, Response $response) use ($app) {

    $return = $response->withJson(['conseguiu acessar a rota'], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});*/

/**
 * Retornando mais informações do livro informado pelo id
 */
/*
$app->get('/person/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $person = new Person();

    $person->setId($id);

    $idperson = $person->getId();    

    $return = $response->withJson(['personid' => "$idperson"], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});
*/

/**
 * Cadastra uma nova Pessoa
 */
$app->post('/person', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $person = new Person();

    $person->setName($params->name);
    $person->setEmail($params->email);
    $person->setPhone($params->phone);
    $person->setSite($params->site);
    $person->setAddress($params->address);
    $person->setCPF($params->cpf);


    $return = $response->withJson(json_encode($person->getName()), 201)
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
 * Deleta o livro informado pelo ID
 */
/*
$app->delete('/book/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');    
    $return = $response->withJson(['msg' => "Deletando o livro {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});
*/

/*$app->get('/token', function (Request $request, Response $response) use ($app) {

    $key = "example_key";
    $token = array(
        "iss" => "http://example.org",
        "aud" => "http://example.com",
        "iat" => 1356999524,
        "nbf" => 1357000000
    );

    /**
     * IMPORTANT:
     * You must specify supported algorithms for your application. See
     * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
     * for a list of spec-compliant algorithms.
     */
    /*$jwt = JWT::encode($token, $key);
    $decoded = JWT::decode($jwt, $key, array('HS256'));

    $return = $response->withJson($decoded, 200)
    ->withHeader('Content-type', 'application/json');
    
    return $return;
});*/


$app->run();

?>
