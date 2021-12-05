<?php

use App\Database\Database;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;

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



} else {
    ?>
    <div class="container">
    <?php foreach ($recipes as $recipe) {
        $recipesComments = $managerComment->getAllCommentsByPost($recipe['id']);
        $recipeUser = $managerUser->getUser($recipe['author_id']);
        ?>

        <a href="modifPost.php?id=<?php echo $recipe['id']?>">
            <div class="post-container">
                <div class="post px-3 bg-primary">
                    <div class="d-flex a-i-center mb-1 secondary">
                        <h2><?php echo $recipe['title']; ?></h2>
                    </div>
                    <img alt=""
                         src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8N3x8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80"/>
                    <p class="p-3 secondary"><?php echo $recipe['content']; ?></p>
                    <div class="d-flex ms-auto p-3 secondary">
                        <span class="author"
                              style="width: 100%"><?php echo $recipeUser['first_name']; ?><?php echo $recipeUser['last_name']; ?></span>
                        <span class="hour"><?php echo $recipe['publish_date']; ?></span>
                    </div>
                </div>
        </a>

        <div class="comments px-3">
            <div class="mb-1">
                <h3>Commentaires</h3>

                <?php foreach ($recipesComments

                as $recipeComment) {
                $recipeUser = $managerUser->getUser($recipeComment['author_id']); ?>

                <h6 class="comment-author"><?php echo $recipeUser['first_name']; ?> <?php echo $recipeUser['last_name']; ?>
                    : </h6>

                <p><?php echo $recipeComment['publish_date']; ?></p>

                <p class="comment px-3 pt-1"><?php echo $recipeComment['content']; ?></p>
            </div>
            <?php } ?>

            <form method="post">
                <div class="py-3">
                    <textarea name="content" id="input1" class="w-100" rows="4" cols="48"></textarea>
                    <div>
                        <input name="post_id" value="<?php echo $recipe['id'] ?>" style="display: none">
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

