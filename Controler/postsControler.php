<?php
include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'display':
        $user = $_SESSION['user'];
        if(!isset($_REQUEST['id'])){
            $posts = getAllPosts();
            include(__DIR__.'/../View/post.php');
        }
        if(isset($_REQUEST['id'])){
            $postv = getPostById($_REQUEST['id']);
            include(__DIR__.'/../View/post.php');
        }

        break;

    case 'setpost':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $id = $_REQUEST['id'];
            $post = getPostById($id);
            if($user->username === $post->username || $user->id === "1") {
                $categories = getAllCategories();
                include(__DIR__.'/../View/setpost.php');
            }
            if($user->username !== $post->username || $user->id !== "1") {
                $postv = $post;
                include(__DIR__.'/../View/post.php');
            }
        }
        if(!isset($_SESSION['user'])){
            include (__DIR__.'/../View/connection.php');
        }
        break;

    case 'updatepost':
        
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
        $img = $_FILES['image'];
        $file = $_FILES['image'];
        //addPost($title, $img, $content, $category, $user);
        $path = dirname(dirname(__FILE__)) . '/asset/img/';
        var_dump($path);
        $res = move_uploaded_file($file['tmp_name'], $path);

        include(__DIR__.'/../View/post.php');
        break;
}






