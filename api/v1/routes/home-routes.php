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

/**
 * get the donation purpose by login and slug
 */
$app->get('/page/{login}/{slug}', function (Request $request, Response $response) use ($app) {

        $route = $request->getAttribute('route');
        $login = $route->getArgument('login');
        $slug = $route->getArgument('slug'); 

        $dpDAO = new DonationPurposeDAO();
      
        $result = $dpDAO->getDonationPurposeByLoginSlug( $login, $slug);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

?>