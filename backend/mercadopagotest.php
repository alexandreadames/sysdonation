<?php 
/*
https://www.mercadopago.com/mlb/account/credentials?type=basic
CLIENT_ID: 7306683431211794
CLIENT_SECRET: RQ7WvjtA3yywqiIIXz3INptoHLZTJ84c
*/

define("CLIENT_ID", "7306683431211794");
define("CLIENT_SECRET", "RQ7WvjtA3yywqiIIXz3INptoHLZTJ84c");

require_once ("..".DIRECTORY_SEPARATOR."config.php");

$mp = new MP (CLIENT_ID, CLIENT_SECRET);

$preference_data = array(
    "items" => array(
        array(
            "title" => "Title of what you are paying for",
            "currency_id" => "BRL",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 10.2
        )
    )
);
$preference = $mp->create_preference($preference_data);
?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
       	<a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Pay</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    </body>
</html>

