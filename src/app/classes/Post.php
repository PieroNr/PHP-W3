<?php

namespace App\classes;

class Post{

    // Connection
    private $conn;

    // Table
    private $db_table = "posts";

    // Columns
    public $id;
    public $ispublished;
    public $authorid;
    public $content;
    public $publish;
    public $title;
    public $image_url;

    // Db connection
    /**
     * @var string
     */


    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getPosts(){
        $sqlQuery = "SELECT * FROM " . $this->db_table . " ";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createPost(){
        $sqlQuery = "INSERT INTO ". $this->db_table ."
                    SET
                        is_published = :ispublished, 
                        author_id = :authorid, 
                        content = :content, 
                        publish_date = :publish,
                        title = :title,
                        image_url = :image_url";



        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->ispublished=htmlspecialchars(strip_tags($this->ispublished));
        $this->authorid=htmlspecialchars(strip_tags($this->authorid));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->publish=htmlspecialchars(strip_tags($this->publish));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));

        // bind data
        $stmt->bindParam(":ispublished", $this->ispublished);
        $stmt->bindParam(":authorid", $this->authorid);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":publish", $this->publish);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":image_url", $this->image_url);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSinglePost(){
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

        $this->ispublished = $dataRow['is_published'];
        $this->authorid = $dataRow['author_id'];
        $this->content = $dataRow['content'];
        $this->publish = $dataRow['publish_date'];
        $this->title = $dataRow['title'];
        $this->title = $dataRow['image_url'];
    }

    // UPDATE
    public function updatePost(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        is_published = :ispublished, 
                        author_id = :authorid, 
                        content = :content, 
                        publish_date = :publish,
                        title = :title,
                        image_url = :image_url  
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->ispublished=htmlspecialchars(strip_tags($this->ispublished));
        $this->authorid=htmlspecialchars(strip_tags($this->authorid));
        $this->content=htmlspecialchars(strip_tags($this->content));
        $this->publish=htmlspecialchars(strip_tags($this->publish));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));
        $this->title=htmlspecialchars(strip_tags($this->title));

        // bind data
        $stmt->bindParam(":ispublished", $this->ispublished);
        $stmt->bindParam(":authorid", $this->authorid);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":publish", $this->publish);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":image_url", $this->image_url);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deletePost(){
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
