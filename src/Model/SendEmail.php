<?php
namespace App\Model;
use Carbon\Carbon;
class SendEmail {
    //Class Ini mirip seperti model yang ada di framework CI/Laravel. berfungsi untuk connect ke table
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insert(Array $input)
    {
        $statement = "INSERT INTO send_email(from_, subject_, to_, content, created_at) VALUES (:from_, :subject_, :to_, :content, :created_at)";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'from_' => $input['from'],
                'subject_'  => $input['subject'],
                'to_' => $input['to'],
                'content' => $input['content'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    
}