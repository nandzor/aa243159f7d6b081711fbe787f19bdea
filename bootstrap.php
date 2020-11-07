<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use App\System\DatabaseConnector;
$dotenv = new DotEnv(__DIR__);
if(file_exists(".env")) {
    $dotenv->load();
}

$dbConnection = (new DatabaseConnector())->getConnection();
