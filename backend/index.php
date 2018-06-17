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
//Test Routes COMMENTED
//require_once("routes/test-routes.php");


//Run Slim
$app->run();

?>
