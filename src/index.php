<?php

use App\Controller\UserController;
use App\Controller\PostController;
use App\Controller\CommentController;
use App\Database\Database;

require './vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$database = new Database();
$db = $database->getConnection();
if ($uri[1] == 'api') {
    if ($uri[2] == 'user') {
        header("HTTP/1.1 404 Not Found");
        $userId = null;
        if (isset($uri[3])) {
            $userId = (int)$uri[3];
        }

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $controller = new UserController($requestMethod, $userId);
        $controller->processRequest();
    } elseif ($uri[2] == 'post') {
        header("HTTP/1.1 404 Not Found");
        $postId = null;
        if (isset($uri[3])) {
            $postId = (int)$uri[3];
        }

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $controller = new PostController($requestMethod, $postId);
        $controller->processRequest();
    } elseif ($uri[2] == 'comment') {
        header("HTTP/1.1 404 Not Found");
        $commentId = null;
        if (isset($uri[3])) {
            $commentId = (int)$uri[3];
        }

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $controller = new CommentController($requestMethod, $commentId);
        $controller->processRequest();
    }
}



