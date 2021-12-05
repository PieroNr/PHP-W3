<?php

namespace App\Manager;


use App\Model\Comment;
use PDO;

class CommentManager
{

    private \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * @return Comment[]|bool
     */
    public function getAllComments()
    {
        $query = "SELECT * FROM `comments`";
        $res = $this->db->query($query);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $post_id
     * @return array
     */
    public function getAllCommentsByPost($post_id)
    {
        $query = "SELECT * FROM `comments` WHERE post_id = $post_id";
        $res = $this->db->query($query);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getComment($id)
    {
        $query = "SELECT * FROM `comments` WHERE id = $id LIMIT 0,1";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $input
     * @return false|\PDOStatement
     */
    public function createComment($input)
    {
        $query = "INSERT INTO comments(author_id, content, publish_date, post_id) 
                  VALUES (" .$input['author_id']. ",'" .$input['content']. "','" .$input['publish_date']. "'," .$input['post_id']. ");";

        return $this->db->query($query);

    }

    /**
     * @param $id
     * @param $input
     * @return false|\PDOStatement
     */
    public function updateComment($id, $input)
    {
        $query = "UPDATE comments 
                  SET 
                      author_id=" .$input['author_id']. ",
                      content='" .$input['content']. "',
                      publish_date='" .$input['publish_date']. "',
                      post_id=" .$input['post_id']. "   
                  WHERE 
                        id = $id";

        return $this->db->query($query);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteComment($id)
    {
        $query = "DELETE FROM comments WHERE id = $id";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }
}