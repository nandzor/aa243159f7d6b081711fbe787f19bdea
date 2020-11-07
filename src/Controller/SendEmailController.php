<?php
namespace App\Controller;
use App\Model\SendEmail;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendEmailController {

    private $db;
    private $requestMethod;

    private $sendEmail;
    // private $token;
    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->sendEmail = new SendEmail($db);


        // obtain an access token
        // $this->token = $this->obtainToken(getenv('OKTAISSUER'), getenv('OKTACLIENTID'), getenv('OKTASECRET'), getenv('SCOPE'));

    }

    // end of client.php flow

    // function obtainToken($issuer, $clientId, $clientSecret, $scope) {
    //     echo "Obtaining token...";

    //     // prepare the request
    //     $uri = $issuer . '/v1/token';
    //     $token = base64_encode("$clientId:$clientSecret");
    //     $payload = http_build_query([
    //         'grant_type' => 'client_credentials',
    //         'scope'      => $scope
    //     ]);

    //     // build the curl request
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $uri);
    //     curl_setopt( $ch, CURLOPT_HTTPHEADER, [
    //         'Content-Type: application/x-www-form-urlencoded',
    //         "Authorization: Basic $token"
    //     ]);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     // process and return the response
    //     $response = curl_exec($ch);
    //     $response = json_decode($response, true);
    //     if (! isset($response['access_token'])
    //         || ! isset($response['token_type'])) {
    //         exit('failed, exiting.');
    //     }

    //     echo "success!\n";
    //     // here's your token to use in API requests
    //     return $response['token_type'] . " " . $response['access_token'];
    // }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->sendEmailRequest();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function sendEmailRequest()
    {
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/api_email/send");
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        //     'Content-Type: application/json',
        //     "Authorization: $this->token"
        // ]);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
       
        $input = array();
        $input['from'] = $_POST['from'];
        $input['subject'] = $_POST['subject'];
        $input['to'] = $_POST['to'];
        $input['content'] = $_POST['content'];

        $mail = new PHPMailer (true); //Argument true in constructor enables exceptions
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = getenv('MAIL_HOST');
        $mail->Port = getenv('MAIL_PORT');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MAIL_USERNAME');
        $mail->Password = getenv('MAIL_PASSWORD');
        $mail->setFrom($input['from'], 'Nanda');
        $mail->addReplyTo($input['from'], 'Reply');
        $mail->addAddress($input['to']);
        $mail->Subject = $input['subject'];
        $mail->isHTML(true);
        $mail->Body = $input['content'];
        try {
            $mail->send();
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        $this->insertDataEmail($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = var_dump($input);
        return $response;
        
        
    }

    private function insertDataEmail($input) { //insert data ke table
        if (! $this->validate($input)) {
            return $this->unprocessableEntityResponse();
        }
        //function sendemail
        $this->sendEmail->insert($input);
    }

    private function validate($input)
    {
        if (! isset($input['from'])) {
            return false;
        }
        if (! isset($input['subject'])) {
            return false;
        }
        if (! isset($input['to'])) {
            return false;
        }
        if (! isset($input['content'])) {
            return false;
        }
        return true;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}