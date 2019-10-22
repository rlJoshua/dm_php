<?php
include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'display':
        $posts = getAllPosts();
        include(__DIR__.'/../View/post.php');
        break;

    case 'addpost':
        if(isset($_SESSION['user'])){
            $categories = getAllCategories();
            $user = $_SESSION['user'];
            include(__DIR__.'/../View/addpost.php');
        }
        if(!isset($_SESSION['user'])){
            include (__DIR__.'/../View/connection.php');
        }
        break;

    case 'createpost':
        $title = $_REQUEST['title'];
        $content= $_REQUEST['content'];
        $category = $_REQUEST['category'];
        $user = $_SESSION['user']->id;
        $img = $_REQUEST['image'];
        include(__DIR__.'/../View/addpost.php');
        break;
}






