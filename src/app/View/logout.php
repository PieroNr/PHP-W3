<?php
session_start();
session_destroy();
header('Location: http://localhost:5555/app/view/posts.php');
exit();
?>