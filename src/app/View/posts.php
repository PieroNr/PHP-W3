<?php

use App\Database\Database;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

session_start();

ob_start();


require '../../vendor/autoload.php';


$managerPost = new PostManager(Database::getConnection());
$recipes = $managerPost->getAllPosts();
$managerComment = new CommentManager(Database::getConnection());
$managerUser = new UserManager(Database::getConnection());


if (isset($_POST['content'], $_POST['post_id'])) {


    $comment = array(
        'content' => $_POST['content'],
        'post_id' => $_POST['post_id'],
        'publish_date' => date("Y-m-d"),
        'author_id' => 1
    );


    $managerComment->createComment($comment);



}
    ?>
    <div class="container">
        <button class="btn btn-secondary" onclick="window.location.href = 'createPost.php';">Créer Post</button>
    <?php foreach ($recipes as $recipe) {
        $recipesComments = $managerComment->getAllCommentsByPost($recipe['id']);
        $recipeUser = $managerUser->getUser($recipe['author_id']);
        ?>


            <div class="post-container">
                <div class="post px-3 bg-primary">

                    <div class="d-flex a-i-center mb-1 secondary">
                        <h2><?php echo $recipe['title']; ?></h2>
                    </div>
                    <img alt=""
                         src="http://localhost:5555<?php echo $recipe['image_url'] ?>"/>
                    <p class="p-3 secondary"><?php echo $recipe['content']; ?></p>
                    <div class="d-flex ms-auto p-3 secondary">
                        <span class="author"
                              style="width: 100%"><?php echo $recipeUser['first_name']; ?> <?php echo $recipeUser['last_name']; ?></span>
                        <span class="hour"><?php echo $recipe['publish_date']; ?></span>
                    </div>
                    <?php

                    if(isset($_SESSION['login'], $_SESSION['mdp'])) {
                        if ($_SESSION['is_admin'] == 1) {
                            ?>
                            <li class="px-3">
                                <button class="btn btn-secondary"
                                        onclick="window.location.href = 'modifPost.php?id=<?php echo $recipe['id']; ?>';">
                                    Modifier
                                </button>

                            </li>
                            <li class="px-3">
                                <button class="btn btn-danger"
                                        onclick="window.location.href = 'deletePost.php?id=<?php echo $recipe['id']; ?>';">
                                    Supprimer
                                </button>
                            </li>
                        <?php }
                    }?>


                </div>


                <div class="comments px-3">
                        <h3>Commentaires</h3>

                        <?php foreach ($recipesComments  as $recipeComment) {
                        $recipeUser = $managerUser->getUser($recipeComment['author_id']); ?>

                                <div class="mb-1">

                                <h6 class="comment-author"><?php echo $recipeUser['first_name']; ?> <?php echo $recipeUser['last_name']; ?>
                                    : </h6>

                                <p><?php echo $recipeComment['publish_date']; ?></p>

                                <p class="comment px-3 pt-1"><?php echo $recipeComment['content']; ?></p>
                            </div>

                    <?php } ?>
                </div>
                    <form method="post" action="posts.php">
                        <div class="py-3">
                            <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
                            <div>
                                <input name="post_id" value="<?php echo $recipe['id'] ?>" style="display: none">
                                <button type="submit" class="btn btn-secondary">Commenter</button>
                            </div>
                        </div>
                    </form>



<?php }

$content = ob_get_clean();
require_once("template.php"); ?>

