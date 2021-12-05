<?php
namespace App\Controller;

use App\Manager\CommentManager;
use App\Model\Comment;
use App\Database\Database;

class CommentController {


    private $requestMethod;
    private $commentId;


    public function __construct($requestMethod, $commentId)
    {

        $this->requestMethod = $requestMethod;
        $this->commentId = $commentId;


    }

    /**
     *
     */
    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->commentId) {
                    $response = $this->getComment($this->commentId);
                } else {
                    $response = $this->getAllComments();
                };
                break;
            case 'POST':
                $response = $this->createCommentFromRequest();
                break;
            case 'PUT':
                $response = $this->updateCommentFromRequest($this->commentId);
                break;
            case 'DELETE':
                $response = $this->deleteComment($this->commentId);
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
    private function getAllComments()
    {
        $manager = new CommentManager(Database::getConnection());
        $comments = $manager->getAllComments();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($comments);

        echo $response['body'];
        exit;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function getComment($id)
    {
        $manager = new CommentManager(Database::getConnection());
        $comment = $manager->getComment($id);

        if (! $comment) {
            return $this->notFoundResponse();
        }
        $item = new Comment($comment);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($item);

        return $response;
    }

    /**
     * @return mixed|void
     */
    private function createCommentFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new CommentManager(Database::getConnection());



        if (! $this->validateComment($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->createComment($input)){
            echo "Comment cannot be created";
            return;
        } else {

            echo "Comment created successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }

        return $response;
    }

    /**
     * @param $id
     * @return mixed|void
     */
    private function updateCommentFromRequest($id)
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $manager = new CommentManager(Database::getConnection());


        if (! $this->validateComment($input)) {
            return $this->unprocessableEntityResponse();
        }

        if(!$manager->updateComment($id, $input)){
            echo "Comment cannot be updated";
            return;
        } else {

            echo "Comment updated successfully";
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;

        }
        return $response;
    }

    /**
     * @param $id
     * @return mixed
     */
    private function deleteComment($id)
    {
        $manager = new CommentManager(Database::getConnection());
        $comment = $manager->deleteComment($id);

        if (! $comment) {
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
    private function validateComment($input)
    {
        if (! isset($input['author_id'])) {
            return false;
        }
        if (! isset($input['content'])) {
            return false;
        }
        if (! isset($input['publish_date'])) {
            return false;
        }
        if (! isset($input['post_id'])) {
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