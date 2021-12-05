<?php
ob_start();

use App\Database\Database;
use App\Manager\PostManager;
use App\Manager\CommentManager;
use App\Manager\UserManager;

require '../../vendor/autoload.php';


$managerPost = new PostManager(Database::getConnection());
$managerComment = new CommentManager(Database::getConnection());
$managerUser = new UserManager(Database::getConnection());


if (isset($_GET['id']) and $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $managerPost = new PostManager(Database::getConnection());
    $recipes = $managerPost->getPost($_GET['id']);



    if (isset($_POST['content'], $_POST['post_id'])) {


        $comment = array(
            'content' => $_POST['content'],
            'post_id' => $_POST['post_id'],
            'publish_date' => date("Y-m-d"),
            'author_id' => 1
        );


        $managerComment->createComment($comment);


    } else if (isset($_POST['title'], $_POST['contentPost'])) {

        $input = array(
            'title' => $_POST['title'],
            'image_url' => $recipes['image_url'],
            'content' => $_POST['contentPost'],
            'is_published' => 1,
            'publish_date' => date("Y-m-d"),
            'author_id' => $recipes['author_id']
        );


        $managerPost->updatePost($recipes['id'],$input);
    } else if (isset($_POST['contentComment'], $_POST['idComment'], $_POST['author_id'])){

        $input = array(
            'author_id' => $_POST['author_id'],
            'content' => $_POST['contentComment'],
            'publish_date' => date("Y-m-d"),
            'post_id' => $recipes['id']
        );

        $managerComment->updateComment($_POST['idComment'],$input);
    } else {
        ?>
        <div class="container">
            <?php
            $recipesComments = $managerComment->getAllCommentsByPost($recipes['id']);
            $recipeUser = $managerUser->getUser($recipes['author_id']);

            ?>
            <form method="post">
                <div class="post-container">
                    <div class="post px-3 bg-primary">

                        <input type="text" name="title" value="<?php echo $recipes['title']; ?>" required>

                        <img alt=""
                             src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80"/>

                        <input type="text" name="contentPost" value="<?php echo $recipes['content']; ?>" required>
                        <div class="d-flex ms-auto p-3 secondary">
                        <span class="author"
                              style="width: 100%"><?php echo $recipeUser['first_name']; ?><?php echo $recipeUser['last_name']; ?></span>
                            <span class="hour"><?php echo $recipes['publish_date']; ?></span>
                        </div>
                    </div>
                    <input type="submit" value="Enregistrer">
            </form>

            <div class="comments px-3">
                <div class="mb-1">
                    <h3>Commentaires</h3>
                    <?php foreach ($recipesComments as $recipeComment) { ?>
                        <form method="post" href="modifPost.php?id=<?php echo $recipes['id']?>">

                            <?php $recipeUser = $managerUser->getUser($recipeComment['author_id']); ?>

                            <h6 class="comment-author"><?php echo $recipeUser['first_name']; ?> <?php echo $recipeUser['last_name']; ?>
                                : </h6>

                            <p><?php echo $recipeComment['publish_date']; ?></p>

                            <input style="display: none;" type="text" name="idComment" value="<?php echo $recipeComment['id']; ?>">
                            <input style="display: none;" type="text" name="author_id" value="<?php echo $recipeComment['author_id']; ?>">

                            <input type="text" name="contentComment" value="<?php echo $recipeComment['content']; ?>">
                            <input type="submit" value="Modifier">



                        </form>
                     <?php } ?>
                </div>
            </div>

            <form method="post">
                <div class="py-3">
                    <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
                    <div>
                        <input name="post_id" value="<?php echo $recipes['id'] ?>" style="display: none">
                        <button type="submit" class="btn btn-secondary">Commenter</button>
                    </div>
                </div>
            </form>

        </div>
        </div>
    <?php } ?>
    </div>
<?php }

$content = ob_get_clean();
require_once("template.php"); ?>


