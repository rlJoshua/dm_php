<?php
include(__DIR__.'/../Model/function.php');
$action = $_GET['ac'];
$user = $_SESSION['user'];
$authorize = getAuthorize($user->id, 1);

if(!$authorize){
    $action = 'post';
}

switch ($action) {

    case 'category':
        if($authorize){
            if(isset($_POST['id'])){
                $id = sanitize($_POST['id']);
                $name = getCategoryNameById($id);
                deleteCategory($id);
                $message = "La catégorie $name à été supprimé !";
            }
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'addcategory':
        if($authorize){
            $name = sanitize($_POST['name']);
            addCategory($name);
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'setcategory':
        if($authorize){
            $id = sanitize($_POST['idcat']);
            $name = sanitize($_POST['namecat']);
            setCategory($id, $name);
            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'post':
        if(getLedgitPage($_GET['page'])){
            $page = intval($_GET['page']);
        }
        if(!getLedgitPage($_GET['page'])){
            $page = 1;
        }
        $posts = getPosts($page);
        $nbpages = ceil(getNbPosts()/10);
        include(__DIR__.'/../View/post.php');
        break;

}






