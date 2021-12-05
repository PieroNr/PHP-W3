<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Model\Post;
use App\Database\Database;

class PostController {


    private $requestMethod;
    private $postId;


    public function __construct($requestMethod, $postId)
    {

        $this->requestMethod = $requestMethod;
        $this->postId = $postId;


    }

    /**
     *
     */
    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->postId) {
                    $response = $this->getPost($this->postId);
                } else {
                    $response = $this->getAllPosts();
                };
                break;
            case 'POST':
                $response = $this->createPostFromRequest();
                break;
            case 'PUT':
                $response = $this->updatePostFromRequest($this->postId);
                break;
            case 'DELETE':
                $response = $this->deletePost($this->postId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    /**
     *
     */
    private function getAllPosts()
    {
        $manager = new PostManager(Database::getConnection());
        $posts = $manager->getAllPosts();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($posts);

        echo $response['body'];
        exit;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getPost($id)
    {
        $manager = new PostManager(Database::getConnection());
        $post = $manager->getPost($id);

        if (! $post) {
            return $this->notFoundResponse();
        }
        $item = new Post($post);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($item);

        return $response;
    }

    /**
     * @return mixed|void
     */
    private function createPostFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new PostManager(Database::getConnection());



        if (! $this->validatePost($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->createPost($input)){
            echo "Post cannot be created";
            return;
        } else {

            echo "Post created successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }

        return $response;
    }

    /**
     * @param $id
     * @return mixed|void
     */
    private function updatePostFromRequest($id)
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new PostManager(Database::getConnection());


        if (! $this->validatePost($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->updatePost($id, $input)){
            echo "Post cannot be updated";
            return;
        } else {

            echo "Post updated successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function deletePost($id)
    {
        $manager = new PostManager(Database::getConnection());
        $post = $manager->deletePost($id);

        if (! $post) {
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
    private function validatePost($input)
    {
        if (! isset($input['title'])) {
            return false;
        }
        if (! isset($input['is_published'])) {
            return false;
        }
        if (! isset($input['image_url'])) {
            return false;
        }
        if (! isset($input['author_id'])) {
            return false;
        }
        if (! isset($input['content'])) {
            return false;
        }
        if (! isset($input['publish_date'])) {
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