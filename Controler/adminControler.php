<?php
include(__DIR__.'/../Model/function.php');
$action = $_GET['ac'];
$user = $_SESSION['user'];
$authorize = getAuthorize($user->id, 1);

if(!$authorize){
    header('Location: /posts?ac=display');
    exit();
}

switch ($action) {

    case 'category':
        if($authorize){

            $categories = getCategories();
            include(__DIR__.'/../View/category.php');
        }
        break;

    case 'addcategory':
        if($authorize){
            $name = sanitize($_POST['name']);
            addCategory($name);
            header('Location: /admin?ac=category');
            exit();
        }
        break;

    case 'setcategory':
        if($authorize){
            $id = sanitize($_POST['idcat']);
            $name = sanitize($_POST['namecat']);
            setCategory($id, $name);
            header('Location: /admin?ac=category');
            exit();
        }
        break;

    case "deletecategory":
        if($authorize){
            if(isset($_GET['id'])){
                $id = sanitize($_GET['id']);
                $name = getCategoryNameById($id);
                deleteCategory($id);
                header('Location: /admin?ac=category');
                exit();
            }
            if(!isset($_GET['id'])){
                header('Location: /admin?ac=category');
                exit();
            }
        }
}






