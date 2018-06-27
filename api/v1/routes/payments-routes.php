<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Entities
 */
use \App\Models\Entity\PaymentMethod;
use \App\Models\DAO\PaymentMethodDAO;


/**
 * Utils
 */
use \App\Models\Utils\TokenUtils;


/**
 * Cadastra ou Atualiza um perfil
 */
$app->post('/secure/payment-method', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $decoded_token = TokenUtils::decodeToken($request);   

    $paymentMethod = new PaymentMethod();

    $paymentMethod->setIdUser((int) $decoded_token["userId"]);
    $paymentMethod->setDescription($params->description);
    $paymentMethod->setClientId($params->clientid);
    $paymentMethod->setClientSecret($params->clientsecret);

    $pmDAO = new PaymentMethodDAO();

    $result = $pmDAO->createOrUpdate($paymentMethod);
    
    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json');
    
    return $return;
});

/**
 * Tenta buscar o método de pagamento
 */
$app->get('/secure/payment-method', function (Request $request, Response $response) use ($app) {

        //$route = $request->getAttribute('route');
        //$id = $route->getArgument('id'); 

        $decoded_token = TokenUtils::decodeToken($request);   

        $pmDAO = new PaymentMethodDAO();

        $result = $pmDAO->getPaymentMethodByUserId( (int) $decoded_token["userId"]);

        $return = $response->withJson($result, 200)
            ->withHeader('Content-type', 'application/json');

        return $return;

});


?>