<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Entities
 */
use \App\Models\Entity\Person;


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

?>