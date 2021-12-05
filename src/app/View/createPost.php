<?php
ob_start();

use App\Database\Database;
use App\Manager\PostManager;

require '../../vendor/autoload.php';


    if (isset($_POST['title'], $_POST['content'],  $_FILES['image'])){



    $title = stripslashes($_POST['title']);
    $content = stripslashes($_POST['content']);
    $author_id = 1;
    $tmp_name = $_FILES["image"]["tmp_name"];
    // basename() peut empêcher les attaques de système de fichiers;
    // la validation/assainissement supplémentaire du nom de fichier peut être approprié
    $name = basename($_FILES["image"]["name"]);
    // echo   move_uploaded_file($tmp_name, "$uploaddir/$name");
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/";



        $post = array(
                'title'=>$title,
                'is_published'=>1,
                'image_url'=>'zeubi',
                'author_id'=>1,
                'content'=>$content,
                'publish_date'=>date("Y-m-d")
    );


        $manager = new PostManager(Database::getConnection());
        $manager->createPost($post);


        //header('Location: http://localhost:5555/index.php');
    //exit();


    }else{ ?>

<form method="post" enctype="multipart/form-data">
    <div class="createPost">
        <label for="title">Title</label>
        <textarea name="title" id="input1" class="w-100" rows="4" cols="48"></textarea><br/>

        <label for="file">
            <input type="file" name="image" id="fileToUpload">
        </label>

        <label for="content" >Description</label><br/>
        <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
        <button class="btn" type="submit">Ajouter l'article</button>
    </div>
</form>

<?php }
$content = ob_get_clean();
require_once("template.php"); ?>
