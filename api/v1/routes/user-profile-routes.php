<?php

/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Entities
 */
use \App\Models\Entity\UserProfile;
use \App\Models\DAO\UserProfileDAO;



/**
 * Utils
 */
use \App\Models\Utils\TokenUtils;


/**
 * Cadastra ou Atualiza um perfil
 */
$app->post('/secure/user-profile', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    $decoded_token = TokenUtils::decodeToken($request);   

    $userProfile = new UserProfile();

    $userProfile->setIdUser((int) $decoded_token["userId"]);
    $userProfile->setDescription($params->description);
    $userProfile->setOccupation($params->occupation);
    $userProfile->setProfilePicture($params->avatar['value']);
    $userProfile->setFileType($params->avatar['filetype']);
    $userProfile->setFileName($params->avatar['filename']);


    $upDAO = new UserProfileDAO();

    $result = $upDAO->createOrUpdate($userProfile);
    
    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json');
    
    return $return;
});

/**
 * Cadastra uma nova Pessoa
 */
$app->get('/secure/user-profile', function (Request $request, Response $response) use ($app) {

    //$params = (object) $request->getParams();

    $decoded_token = TokenUtils::decodeToken($request);   

    $userProfile = new UserProfile();

    /*
        $userProfile->setIdUser((int) $decoded_token["userId"]);
        $userProfile->setDescription($params->description);
        $userProfile->setOccupation($params->occupation);
        $userProfile->setProfilePicture($params->avatar['value']);
        $userProfile->setFileType($params->avatar['filetype']);
        $userProfile->setFileName($params->avatar['filename']);
    */

    $upDAO = new UserProfileDAO();

    $result = $upDAO->getProfileUserById( (int) $decoded_token["userId"]);
    
    $return = $response->withJson($result, 200)
        ->withHeader('Content-type', 'application/json');
    
    return $return;
});

?>