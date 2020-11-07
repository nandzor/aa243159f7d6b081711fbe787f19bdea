<?php

require "bootstrap.php";
use App\Controller\SendEmailController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
require_auth();
// all of our endpoints start with 
// everything else results in a 404 Not Found
// if (authenticate()) {
    if ($uri[2] === 'send') {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        // pass the request method and user ID to the PersonController and process the HTTP request:
        $controller = new SendEmailController($dbConnection, $requestMethod);
        $controller->processRequest();
    } else {
        header("HTTP/1.1 404 Not Found");
        exit();
    }
// } else {
//     header("HTTP/1.1 401 Unauthorized");
//     exit('Unauthorized');
// }

function require_auth() {
	$AUTH_USER = 'admin';
	$AUTH_PASS = 'admin';
	header('Cache-Control: no-cache, must-revalidate, max-age=0');
	$has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
	$is_not_authenticated = (
		!$has_supplied_credentials ||
		$_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
		$_SERVER['PHP_AUTH_PW']   != $AUTH_PASS
	);
	if ($is_not_authenticated) {
		header('HTTP/1.1 401 Authorization Required');
		header('WWW-Authenticate: Basic realm="Access denied"');
		exit;
	}
}

// authenticate the request with Okta:
// function authenticate() {
//     try {
//         switch(true) {
//             case array_key_exists('HTTP_AUTHORIZATION', $_SERVER) :
//                 $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
//                 break;
//             case array_key_exists('Authorization', $_SERVER) :
//                 $authHeader = $_SERVER['Authorization'];
//                 break;
//             default :
//                 $authHeader = null;
//                 break;
//         }
//         preg_match('/Bearer\s(\S+)/', $authHeader, $matches);
//         if(!isset($matches[1])) {
//             throw new \Exception('No Bearer Token');
//         }
//         $jwtVerifier = (new \Okta\JwtVerifier\JwtVerifierBuilder())
//             ->setIssuer(getenv('OKTAISSUER'))
//             ->setAudience('api://default')
//             ->setClientId(getenv('OKTACLIENTID'))
//             ->build();
//         return $jwtVerifier->verify($matches[1]);
//     } catch (\Exception $e) {
//         return false;
//     }
// }




