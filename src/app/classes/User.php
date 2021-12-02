<?php

namespace App\classes;

class User{

    // Connection
    private $conn;

    // Table
    private $db_table = "users";

    // Columns
    public $id;
    public $firstname;
    public $lastname;
    public $isadmin;
    public $email;
    public $password;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getUsers(){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createUser(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        first_name = :firstname, 
                        last_name = :lastname, 
                        is_admin = :isadmin, 
                        email = :email, 
                        password = :password";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->isadmin=htmlspecialchars(strip_tags($this->isadmin));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // bind data
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":isadmin", $this->isadmin);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleUser(){
        $sqlQuery = "SELECT
                        *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->firstname = $dataRow['first_name'];
        $this->lastname = $dataRow['last_name'];
        $this->isadmin = $dataRow['is_admin'];
        $this->email = $dataRow['email'];
        $this->password = $dataRow['password'];
    }

    // UPDATE
    public function updateUser(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        first_name = :firstname, 
                        last_name = :lastname, 
                        is_admin = :isadmin, 
                        email = :email, 
                        password = :password
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->isadmin=htmlspecialchars(strip_tags($this->isadmin));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":isadmin", $this->isadmin);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deleteUser(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>
