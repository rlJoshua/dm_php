<?php
include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'display':
        $user = $_SESSION['user'];
        if(!isset($_REQUEST['id'])){
            $posts = getPosts();
            include(__DIR__.'/../View/post.php');
        }
        if(isset($_REQUEST['id'])){
            $postv = getPostById($_REQUEST['id']);
            $authorize = getAuthorize($user->id, $postv->idUser);
            $comments = getComments($postv->id);
            include(__DIR__.'/../View/post.php');
        }
        break;

    case 'setpost':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $id = $_REQUEST['id'];
            $post = getPostById($id);
            $authorize = getAuthorize($user->id, $post->idUser);
            if($authorize) {
                $categories = getCategories();
                include(__DIR__.'/../View/setpost.php');
            }
            if(!$authorize) {
                $postv = $post;
                $comments = getComments($postv->id);
                include(__DIR__.'/../View/post.php');
            }
        }
        if(!isset($_SESSION['user'])){
            include (__DIR__.'/../View/connection.php');
        }
        break;

    case 'updatepost':
        $user = $_SESSION['user'];
        $title = sanitize($_REQUEST['title']);
        $content= sanitize($_REQUEST['content']);
        $category = sanitize($_REQUEST['category']);
        $idPost = sanitize($_REQUEST['idPost']);
        $postv = setPost($title, $content, $category, $idPost);
        $authorize = getAuthorize($user->id, $postv->idUser);
        $comments = getComments($postv->id);
        include(__DIR__.'/../View/post.php');
        break;

    case 'addpost':
        if(isset($_SESSION['user'])){
            $categories = getCategories();
            $user = $_SESSION['user'];
            include(__DIR__.'/../View/addpost.php');
        }
        if(!isset($_SESSION['user'])){
            include (__DIR__.'/../View/connection.php');
        }
        break;

    case 'createpost':
        $title = sanitize($_REQUEST['title']);
        $content= sanitize($_REQUEST['content']);
        $category = sanitize($_REQUEST['category']);
        $user = $_SESSION['user'];
        $img = sanitize($_FILES['image']);
        $file = $_FILES['image'];
        addPost($title, $img, $content, $category, $user->id);
        $path = dirname(dirname(__FILE__)) . '/asset/img/';
        var_dump($path);
        $res = move_uploaded_file($file['tmp_name'], $path);
        include(__DIR__.'/../View/post.php');
        break;

    case 'addcomment';
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $content = sanitize($_REQUEST['content']);
            $idPost = sanitize($_REQUEST['idPost']);
            addComment($content, $idPost, $user->id);
            $comments = getComments($idPost);
            $postv = getPostById($idPost);
            $authorize = getAuthorize($user->id, $postv->idUser);
            include(__DIR__.'/../View/post.php');
        }
        if(!isset($_SESSION['user'])){
            include (__DIR__.'/../View/connection.php');
        }
        break;
}






