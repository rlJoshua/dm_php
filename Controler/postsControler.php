<?php
include(__DIR__.'/../Model/function.php');
$action = $_GET['ac'];
if($action ===null){
    $action = "display";
}

switch ($action) {

    case 'display':
        $user = $_SESSION['user'];
        if(!isset($_GET['id'])){
            if(getLedgitPage($_GET['page'])){
                $page = intval($_GET['page']);
            }
            if(!getLedgitPage($_GET['page'])){
                $page = 1;
            }
            $nbpages = ceil(getNbPosts()/10);
            $posts = getPosts($page);
            include(__DIR__.'/../View/post.php');
        }
        if(isset($_GET['id'])){
            $postv = getPostById($_GET['id']);
            $authorize = getAuthorize($user->id, $postv->idUser);
            $comments = getCommentsByPost($postv->id);
            $nbpages = ceil(getNbPosts()/10);
            include(__DIR__.'/../View/post.php');
        }
        break;

    case 'setpost':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $id = $_GET['id'];
            $post = getPostById($id);
            $authorize = getAuthorize($user->id, $post->idUser);
            if($authorize) {
                $categories = getCategories();
                include(__DIR__.'/../View/setpost.php');
            }
            if(!$authorize) {
                header('Location: /posts?ac=display');
                exit();
            }
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'updatepost':
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $category = sanitize($_POST['category']);
            $idPost = sanitize($_POST['idPost']);
            $img = $_FILES['image'];
            $postv = setPost($title, $img, $content, $category, $idPost);
            header("Location: /posts?ac=display&id=$postv->id");
            exit();
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'addpost':
        if(isset($_SESSION['user'])){
            $categories = getCategories();
            $user = $_SESSION['user'];
            include(__DIR__.'/../View/addpost.php');
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'createpost':
        if(isset($_SESSION['user'])) {
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $category = sanitize($_POST['category']);
            $user = $_SESSION['user'];
            $img = $_FILES['image'];
            addPost($title, $img, $content, $category, $user->id);
            header('Location: /posts?ac=display');
            exit();
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'deletepost':
        if(isset($_SESSION['user'])) {
            $idPost = sanitize($_POST['idPost']);
            deletePost($idPost);
            header('Location: /posts?ac=display');
            exit();
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'addcomment';
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $content = sanitize($_POST['content']);
            $idPost = sanitize($_POST['idPost']);
            addComment($content, $idPost, $user->id);
            header("Location: /posts?ac=display&id=$idPost");
            exit();
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'deletecomment';
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $id = sanitize($_GET['id']);
            $comment = getComment($id);
            deleteComment($id);
            header("Location: /posts?ac=display&id=$comment->idPost");
            exit();
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;
}

