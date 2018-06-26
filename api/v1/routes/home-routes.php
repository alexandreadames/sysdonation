<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\Models\DAO\DonationPurposeDAO;


/**
 * Lista de todos os livros
 */
$app->get('/', function (Request $request, Response $response) use ($app) {
   
    $response->getBody()->write("Bem-vindo ao Backend do Sysdonation!");
     return $response;
 });

?>