<?php

namespace App\Manager;


use App\Model\User;
use PDO;

class UserManager
{

    private \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    /**
     * @return User[]|bool
     */
    public function getAllUsers()
    {
        $query = "SELECT * FROM `users`";
        $res = $this->db->query($query);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $query = "SELECT * FROM `users` WHERE id = $id LIMIT 0,1";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param $input
     * @return false|\PDOStatement
     */
    public function createUser($input)
    {
        $query = "INSERT INTO users(first_name, last_name, is_admin, email, password) 
                  VALUES ('" .$input['firstname']. "','" .$input['lastname']. "'," .$input['isadmin']. ",'" .$input['email']. "','" .$input['password']."');";

        return $this->db->query($query);

    }

    /**
     * @param $id
     * @param $input
     * @return false|\PDOStatement
     */
    public function updateUser($id, $input)
    {
        $query = "UPDATE users 
                  SET 
                      first_name='" .$input['firstname']. "',
                      last_name='" .$input['lastname']. "',
                      is_admin=" .$input['isadmin']. ",
                      email='" .$input['email']. "',
                      password='" .$input['password']."' 
                  WHERE 
                        id = $id";

        return $this->db->query($query);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = $id";
        $res = $this->db->query($query);

        return $res->fetch(PDO::FETCH_ASSOC);
    }
}