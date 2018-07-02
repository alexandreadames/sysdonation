<?php
/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\Models\Utils\TokenUtils;
use \App\Models\Utils\Utils;
use \App\Models\Entity\DonationPurpose;
use \App\Models\DAO\DonationPurposeDAO;


/**
 * CREATE
 * Create a new Donation Purpose
 */
$app->post('/secure/donations-purposes', function (Request $request, Response $response) use ($app) {

    $decoded_token = TokenUtils::decodeToken($request);   

    $params = (object) $request->getParams();

    //htmlspecialchars = Encodes Html
    //htmlspecialchars_decode = Decodes Html

    $dp = new DonationPurpose();

    $dp->setTitle($params->title);
    $dp->setHtmlContent($params->html_content);
    $dp->setSlug($params->slug);
    $dp->setIdUser((int) $decoded_token["userId"]);

    $dpDAO = new DonationPurposeDAO();

    $result = $dpDAO->create($dp);
    
    $return = $response->withJson($result, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});

/**
 * READ - PUBLIC
 * GET All Donations Purposes
 */
$app->get('/donations-purposes', function (Request $request, Response $response) use ($app) {

        //$route = $request->getAttribute('route');
        //$id = $route->getArgument('id'); 

        $dpDAO = new DonationPurposeDAO();

        $result = $dpDAO->listAll();

        foreach ($result as &$dp) {
            $dp["html_content"] = Utils::decodeHtml($dp["html_content"]); 
        }

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});

/**
 * READ - SECURE
 * GET All Donations Purposes by User
 */
$app->get('/secure/donations-purposes', function (Request $request, Response $response) use ($app) {

        $decoded_token = TokenUtils::decodeToken($request);

        $dpDAO = new DonationPurposeDAO();

        $result = $dpDAO->getDonationsPurposesByUser( (int) $decoded_token["userId"]);

        if ($result) {
            foreach ($result as &$dp) {
                $dp["html_content"] = Utils::decodeHtml($dp["html_content"]); 
            }
        }

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});


/**
 * UPDATE
 * UPDATES an doantion purpose
 */

/**
 * DELETE
 * DELETES an doantion purpose
 * VERIFICAR POSTERIORMENTE SE O USUÁRIO QUE ESTÁ MANDADO O DELETE TEM PERMISSÃO PARA DELETAR
 */
$app->delete('/secure/donation-purpose/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $decoded_token = TokenUtils::decodeToken($request);

    $dpDAO = new DonationPurposeDAO();

    $result = $dpDAO->delete($id, (int) $decoded_token["userId"]);

    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});



/**
 * GET the donation purpose by login and slug
 */
$app->get('/donations-purposes/{username}/{donation-purpose-slug}', function (Request $request, Response $response) use ($app) {

        $route = $request->getAttribute('route');
        $username = $route->getArgument('username');
        $donation_purpose_slug = $route->getArgument('donation-purpose-slug'); 

        $dpDAO = new DonationPurposeDAO();
      
        $result = $dpDAO->getDonationPurposeByLoginSlug( $username, $donation_purpose_slug);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});


?>
