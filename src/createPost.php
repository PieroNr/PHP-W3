<?php
ob_start();

use App\classes\Post;
use App\Database\Database;

require './vendor/autoload.php';
    if (isset($_POST['title'], $_POST['content'],  $_FILES['fileToUpload'])){

    $database = new Database();
    $db = $database->getConnection();
    $user = new Post($db);

    $imagelink = '/assets/img/' . $_FILES['fileupload']['name'];

    $title = stripslashes($_POST['title']);
    $content = stripslashes($_POST['content']);


    $user->title = $title;
    $user->content = $content;
    $user->image_url = $imagelink;


        echo 'title :' . $_POST["title"];
        echo 'content :' . $_POST["content"];
        echo 'file :' . $_FILES["fileToUpload"]["name"];


        $user->createPost();

        //header('Location: http://localhost:5555/index.php');
    //exit();


    }else{ ?>

<form method="post" enctype="multipart/form-data">
    <div class="createPost">
        <label for="title">Title</label>
        <textarea name="title" id="input1" class="w-100" rows="4" cols="48"></textarea><br/>

        <label for="file">
            <input type="file" name="fileToUpload" id="fileToUpload">
        </label>

        <label for="content" >Description</label><br/>
        <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
        <button class="btn" type="submit">Ajouter l'article</button>
    </div>
</form>

<?php }
$content = ob_get_clean();
require_once("template.php"); ?>
