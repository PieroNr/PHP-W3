<?php

namespace App\classes;

class Articles
{
    public function getArticles()
    {

        $query = '';
        if ($this->id) {
            $query = " AND posts.id ='" . $this->id . "'";
        }
        $sqlQuery = "
		SELECT posts.id, posts.title, posts.image, users.first_name, users.last_name, 
        posts.publish_date, posts.content 
		FROM " . $this->postTable . "
		LEFT JOIN " . $this->usersTable . " ON users.id = posts.author_id
		WHERE posts.is_published = true $query ORDER BY posts.id DESC";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>