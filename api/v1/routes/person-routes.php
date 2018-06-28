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
use \App\Models\DAO\PersonDAO;


use \App\Models\Utils\TokenUtils;


/**
 * Atualiza os dados de uma pessoa
 */
$app->post('/secure/person/update', function (Request $request, Response $response) use ($app) {

    $decoded_token = TokenUtils::decodeToken($request);   

    $params = (object) $request->getParams();

    $person = new Person();

    $person->setName($params->name);
    $person->setEmail($params->email);
    $person->setPhone($params->phone);
    $person->setSite($params->site);
    $person->setAddress($params->address);
    $person->setCPF($params->cpf);

    $personDAO = new PersonDAO();

    $result = $personDAO->updatePerson($person, (int) $decoded_token["userId"]);

    $return = $response->withJson(json_encode($result), 200)
        ->withHeader('Content-type', 'application/json');
    return $return;
});

?>