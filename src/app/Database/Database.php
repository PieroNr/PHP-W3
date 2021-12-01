<?php
namespace App\Database;

class Database{


    private $user  = 'root';
    private $password   = "example";
    private $database  = "projet-cms";

    public function getConnection(){

        $conn = new \mysqli($this->host, $this->user, $this->password, $this->database);

        if($conn->connect_error){
            die("Error failed to connect to MySQL: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
}

?>