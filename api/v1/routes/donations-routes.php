<?php
/**
 * Class Vendors
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \App\Models\Utils\Utils;
use \App\Models\Utils\MercadoPagoUtils;
/**
 * Entities
 */
use \App\Models\Entity\Donation;
use \App\Models\DAO\DonationDAO;
use \App\Models\DAO\PaymentMethodDAO;


/**
 * Cria uma nova doação
 */
$app->post('/donation', function (Request $request, Response $response) use ($app) {

    $params = (object) $request->getParams();

    /*
    params
    ===================
    cpf:"04983863419"
    donateValue:200
    email:"alexandre.adames@gmail.com"
    name: "Alexandre"
    phone_area_code: "84"
    phone_number: "988285116"
    street_name: "Av. Brigadeiro Salema"
    street_number: 714
    surname: "Pontes"
    zip_code:"59628030"

    ==================
    userid: x
    donationpurpose_id: x
    */
    $donation = new Donation();

    $donation->setDonorName($params->name);
    $donation->setDonorSurName($params->surname);
    $donation->setDonorEmail($params->email);
    $donation->setDonorPhoneAreaCode($params->phone_area_code);
    $donation->setDonorPhoneNumber($params->phone_number);
    $donation->setDonorCPF($params->cpf);
    $donation->setDonorStreetName($params->street_name);
    $donation->setDonorStreetNumber($params->street_number);
    $donation->setDonorZipCode($params->zip_code);
    $donation->setDonationValue($params->donation_value);

    $userid = $params->userid;

    $pmDAO = new PaymentMethodDAO();

    $client_credentials = $pmDAO->getPaymentMethodByUserId($userid);

    $mpu = new MercadoPagoUtils();

    $linkMpOrder = $mpu->generateLinkOrder($client_credentials['client_id'], $client_credentials['client_secret'], $donation);

    //Generate Mp Link Order
    $donation->setMpLinkOrder($linkMpOrder);

    //$test = Utils::test();

    $donation->setDonationPurposeId($params->donationpurpose_id);
    $donation->setUserId($userid);

    //$donationDAO = new DonationDAO();

    //$result = $donationDAO->create($donation);
    
    $return = $response->withJson((array)$donation, 201)
        ->withHeader('Content-type', 'application/json');
    return $return;

    
    //USE PARA DEBUG
    /*$response->getBody()->write(json_encode($result));
    return $response;*/
    
    
});




?>
