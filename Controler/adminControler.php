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
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];
                $name = getCategoryNameById($id);
                deleteCategory($id);
                $message = "La catégorie $name à été supprimé !";
            }
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'addcategory':
        $user = $_SESSION['user'];
        $authorize = getAuthorize($user->id, 1);
        if(!$authorize){
            $posts = getPosts();
            include(__DIR__.'/../View/post.php');
        }
        if($authorize){
            $name = $_REQUEST['name'];
            addCategory($name);
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'setcategory':
        $user = $_SESSION['user'];
        $authorize = getAuthorize($user->id, 1);
        if(!$authorize){
            $posts = getPosts();
            include(__DIR__.'/../View/post.php');
        }
        if($authorize){
            $id = $_REQUEST['idcat'];
            $name = $_REQUEST['namecat'];
            setCategory($id, $name);
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

}






