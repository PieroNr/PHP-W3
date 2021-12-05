<?php
namespace App\Controller;

use App\Manager\UserManager;
use App\Model\User;
use App\Database\Database;

class UserController {


    private $requestMethod;
    private $userId;


    public function __construct($requestMethod, $userId)
    {

        $this->requestMethod = $requestMethod;
        $this->userId = $userId;


    }

    /**
     *
     */
    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $response = $this->getUser($this->userId);
                } else {
                    $response = $this->getAllUsers();
                };
                break;
            case 'POST':
                $response = $this->createUserFromRequest();
                break;
            case 'PUT':
                $response = $this->updateUserFromRequest($this->userId);
                break;
            case 'DELETE':
                $response = $this->deleteUser($this->userId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo json_encode($response['body']);
        }
    }

    /**
     *
     */
    private function getAllUsers()
    {
        $manager = new UserManager(Database::getConnection());
        $users = $manager->getAllUsers();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($users);

        echo $response['body'];
        exit;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getUser($id)
    {
        $manager = new UserManager(Database::getConnection());
        $user = $manager->getUser($id);
        var_dump($user);
        if (! $user) {
            return $this->notFoundResponse();
        }
        $item = new User($user);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($item);

        return $response;
    }

    /**
     * @return mixed|void
     */
    private function createUserFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new UserManager(Database::getConnection());



        if (! $this->validateUser($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->createUser($input)){
            echo "User cannot be created";
            return;
        } else {

            echo "User created successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }

        return $response;
    }

    /**
     * @param $id
     * @return mixed|void
     */
    private function updateUserFromRequest($id)
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new UserManager(Database::getConnection());


        if (! $this->validateUser($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->updateUser($id, $input)){
            echo "User cannot be updated";
            return;
        } else {

            echo "User updated successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function deleteUser($id)
    {
        $manager = new UserManager(Database::getConnection());
        $user = $manager->deleteUser($id);

        if (! $user) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    /**
     * @param $input
     * @return bool
     */
    private function validateUser($input)
    {
        if (! isset($input['firstname'])) {
            return false;
        }
        if (! isset($input['lastname'])) {
            return false;
        }
        if (! isset($input['isadmin'])) {
            return false;
        }
        if (! isset($input['email'])) {
            return false;
        }
        if (! isset($input['password'])) {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    /**
     * @return mixed
     */
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}