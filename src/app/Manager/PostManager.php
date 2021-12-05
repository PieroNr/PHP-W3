<?php

namespace App\Manager;


use App\Model\Post;
use PDO;

class PostManager
{

    private \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * @return Post[]|bool
     */
    public function getAllPosts()
    {
        $query = "SELECT * FROM `posts`";
        $res = $this->db->query($query);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id)
    {
        $query = "SELECT * FROM `posts` WHERE id = $id LIMIT 0,1";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $input
     * @return false|\PDOStatement
     */
    public function createPost($input)
    {
        $query = "INSERT INTO posts(title, image_url, content, is_published, publish_date, author_id) 
                  VALUES ('" .$input['title']. "','" .$input['image_url']. "','" .$input['content']. "'," .$input['is_published']. ",'" .$input['publish_date']."'," .$input['author_id']. ");";
    echo $query;
        return $this->db->query($query);

    }

    /**
     * @param $id
     * @param $input
     * @return false|\PDOStatement
     */
    public function updatePost($id, $input)
    {
        $query = "UPDATE posts 
                  SET 
                      title='" .$input['title']. "',
                      is_published=" .$input['is_published']. ",
                      image_url='" .$input['image_url']. "',
                      author_id=" .$input['author_id']. ",
                      content='" .$input['content']."',
                      publish_date='" .$input['publish_date']."'
                  WHERE 
                        id = $id";

        return $this->db->query($query);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id)
    {
        $query = "DELETE FROM posts WHERE id = $id";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }
}