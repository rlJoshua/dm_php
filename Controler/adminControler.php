<?php
include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'category':
        $user = $_SESSION['user'];
        $authorize = getAuthorize($user->id, 1);
        if(!$authorize){
            $posts = getPosts();
            include(__DIR__.'/../View/post.php');
        }
        if($authorize){
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;


}






