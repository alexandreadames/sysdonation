<?php 

namespace App\Models\Utils;


Class MercadoPagoUtils {

	public function generateLinkOrder($client_id, $client_secret, $donation){

	$dt = new \DateTime();
	$today = $dt->format('Y-m-d H:i:s');	

	$mp = new \MP ($client_id, $client_secret);

	$preference_data = array(
	    "items" => array(
	        array(
	            "id" => $donation->getDonationCode(),
	            "title" => $donation->getDonationTitle(),
	            "currency_id" => "BRL",
	            "picture_url" =>"https://www.mercadopago.com/org-img/MP3/home/logomp3.gif",
	            "description" => $donation->getDonationTitle(),
	            "category_id" => "Donation",
	            "quantity" => 1,
	            "unit_price" => $donation->getDonationValue()
	        )
	    ),
	    "payer" => array(
	        "name" => $donation->getDonorName(),
	        "surname" => $donation->getDonorSurName(),
	        "email" => $donation->getDonorEmail(),
	        "date_created" => $today,
	        "phone" => array(
	            "area_code" => $donation->getDonorPhoneAreaCode(),
	            "number" => $donation->getDonorPhoneNumber()
	        ),
	        "identification" => array(
	            "type" => "DNI",
	            "number" => $donation->getDonorCPF()
	        ),
	        "address" => array(
	            "street_name" => $donation->getDonorStreetName(),
	            "street_number" => $donation->getDonorStreetNumber(),
	            "zip_code" => $donation->getDonorZipCode()
	        )
	    ),/*
	    "back_urls" => array(
	        "success" => "https://www.success.com",
	        "failure" => "http://www.failure.com",
	        "pending" => "http://www.pending.com"
	    ),
	    "auto_return" => "approved",*/
	    "payment_methods" => array(
            "excluded_payment_methods" => array(
                array(
                    "id" => "amex",
                    "id" => "pec"
                )
            ),
            "excluded_payment_types" => array(
                array(
                    "id" => "credit_card"
                )
            ),
            "installments" => 24,
            "default_payment_method_id" => "bolbradesco",
            "default_installments" => null,
    	)/*,
	    "shipments" => array(
	        "receiver_address" => array(
	            "zip_code" => "1430",
	            "street_number"=> 123,
	            "street_name"=> "Street",
	            "floor"=> 4,
	            "apartment"=> "C"
	        )
	    ),
	    "notification_url" => "https://www.your-site.com/ipn",
	    "external_reference" => "Reference_1234",
	    "expires" => false,
	    "expiration_date_from" => null,
	    "expiration_date_to" => null*/
	);

	$preference = $mp->create_preference($preference_data);

	/*
	 * Production
	*/
	//Uncomment this for production mode
	//return $preference["response"]["init_point"];
	/*
	 * SandBox - https://www.mercadopago.com.br/developers/pt/solutions/payments/basic-checkout/test/basic-sandbox/
	 Test Payments - https://www.mercadopago.com.br/developers/pt/solutions/payments/basic-checkout/test/test-payments/
	*/
	return $preference["response"]["sandbox_init_point"];

	}

}

 ?>