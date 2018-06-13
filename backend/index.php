<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Entities
 */
use \App\Models\Entity\Person;

/**
 * AutoLoad do Composer
 */
require_once("vendor/autoload.php");

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

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
$app->get('/book', function (Request $request, Response $response) use ($app) {
    $return = $response->withJson(['msg' => 'Lista de Livros'], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Retornando mais informações do livro informado pelo id
 */
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

/**
 * Cadastra um novo Livro
 */
$app->post('/book', function (Request $request, Response $response) use ($app) {
    $return = $response->withJson(['msg' => "Cadastrando um livro"], 201)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Atualiza os dados de um livro
 */
$app->put('/book/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');    
    $return = $response->withJson(['msg' => "Modificando o livro {$id}"], 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

/**
 * Deleta o livro informado pelo ID
 */
$app->delete('/book/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');    
    $return = $response->withJson(['msg' => "Deletando o livro {$id}"], 204)
        ->withHeader('Content-type', 'application/json');
    return $return;
});


$app->run();

?>
