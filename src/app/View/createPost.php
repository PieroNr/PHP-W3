<?php
ob_start();
session_start();
use App\Database\Database;
use App\Manager\PostManager;

require '../../vendor/autoload.php';

if(isset($_SESSION['login'], $_SESSION['mdp'])) {
    if (isset($_POST['title'], $_POST['content'], $_FILES['image'])) {
        if (isset($_FILES["image"])) {
            $tmp_name = $_FILES["image"]["tmp_name"];
            $name = basename($_FILES["image"]["name"]);
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/app/assets/img/";

            if (is_dir($upload_dir) && is_writable($upload_dir)) {
                $moved = move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $name);
                $imageLink = "/app/assets/img/" . $name;
                if ($moved) {

                    $input = array(
                        'title' => $_POST['title'],
                        'content' => $_POST['content'],
                        'publish_date' => date('Y-m-d'),
                        'image_url' => $imageLink,
                        'is_published' => 1,
                        'author_id' => $_SESSION['idUser']
                    );
                    $manager = new PostManager(Database::getConnection());
                    $manager->createPost($input);

                    header('Location: http://localhost:5555/app/view/posts.php');
                    exit();
                } else {
                    echo "Not uploaded because of error #" . $_FILES["image"]["error"];
                }
            } else {
                echo 'Upload directory is not writable, or does not exist.';
            }
        }


    } else { ?>

        <form method="post" enctype="multipart/form-data">
            <div class="createPost">
                <label for="title">Title</label>
                <textarea name="title" id="input1" class="w-100" rows="4" cols="48"></textarea><br/>

                <label for="file">
                    <input type="file" name="image" id="fileToUpload">
                </label>

                <label for="content">Description</label><br/>
                <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
                <button class="btn" type="submit">Ajouter l'article</button>
            </div>
        </form>

    <?php }
} else {
    header('Location: http://localhost:5555/app/view/login.php');
    exit();
}
$content = ob_get_clean();
require_once("template.php"); ?>
