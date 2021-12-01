<?php

use App\classes\Articles;
use App\Database\Database;

require './vendor/autoload.php';



$database = new Database();
$db = $database->getConnection();

$article = new Articles($db);
$result = $article->getArticles();

?>

