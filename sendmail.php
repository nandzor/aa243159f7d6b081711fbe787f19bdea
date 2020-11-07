<?php
// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php
// If you are using Composer (recommended)
require 'vendor/autoload.php';
// If you are not using Composer
// require("path/to/sendgrid-php/sendgrid-php.php");

// initialize dotenv
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$from = new SendGrid\Email("Dian", "dian@petanikode.com");
$subject = "Belajar Kirim Email dengan API SendGrid";
$to = new SendGrid\Email("Ardianta", "ardianta_pargo@yahoo.co.id");
$content = new SendGrid\Content("text/plain", "Hello, ini adalah email yang dikirim melalui API");
$mail = new SendGrid\Mail($from, $subject, $to, $content);
$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

// kirim email
$response = $sg->client->mail()->send()->post($mail);

// untuk debugging
echo "<pre>";
echo $response->statusCode();
print_r($response->headers());
echo $response->body();
echo "</pre>";