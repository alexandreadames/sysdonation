<?php

/**
 * Load Vendors
 */
require './vendor/autoload.php';

/*
*=============================================================================================
* LOAD CONFIGS
*=============================================================================================
*/
require_once("bootstrap.php");


/*
*=============================================================================================
* ROUTES
*=============================================================================================
*/

//Home Routes
require_once("routes/home-routes.php");
//User Routes
require_once("routes/user-routes.php");
//Person Routes
require_once("routes/person-routes.php");
//Donations Purposes Routes
require_once("routes/donations-purposes-routes.php");
//Donations Purposes Routes
require_once("routes/user-profile-routes.php");
//Payments Routes
require_once("routes/payments-routes.php");
//Donations Routes
require_once("routes/donations-routes.php");

//Test Routes COMMENTED
//require_once("routes/test-routes.php");


//Run Slim
$app->run();

?>
