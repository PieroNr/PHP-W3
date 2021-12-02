<?php

namespace App\classes;

class Comment{

    // Connection
    private $conn;

    // Table
    private $db_table = "comments";

    // Columns
    public $id;
    public $authorid;
    public $content;
    public $publish;
    public $postid;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getComment(){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createComment(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        author_id = :authorid, 
                        content = :content, 
                        publish_date = :publish, 
                        post_id = :postid";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->authorid=htmlspecialchars(strip_tags($this->authorid));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->publish=htmlspecialchars(strip_tags($this->publish));
        $this->postid=htmlspecialchars(strip_tags($this->postid));

        // bind data
        $stmt->bindParam(":authorid", $this->authorid);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":publish", $this->publish);
        $stmt->bindParam(":postid", $this->postid);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleComment(){
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

        $this->postid = $dataRow['post_id'];
        $this->authorid = $dataRow['author_id'];
        $this->content = $dataRow['content'];
        $this->publish = $dataRow['publish_date'];
    }

    // UPDATE
    public function updateComment(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        post_id = :postid, 
                        author_id = :authorid, 
                        content = :content, 
                        publish_date = :publish 
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->postid=htmlspecialchars(strip_tags($this->postid));
        $this->authorid=htmlspecialchars(strip_tags($this->authorid));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->publish=htmlspecialchars(strip_tags($this->publish));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":postid", $this->postid);
        $stmt->bindParam(":authorid", $this->authorid);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":publish", $this->publish);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deleteComment(){
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
