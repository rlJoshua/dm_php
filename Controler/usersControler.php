<?php

include(__DIR__.'/../Model/function.php');
$action = $_GET['ac'];

switch ($action) {

    case 'login':
        include(__DIR__.'/../View/connection.php');
        break;

    case 'profil':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            include (__DIR__.'/../View/profil.php');
        }
        if(isset($_POST['user'])){
            $username = sanitize($_POST['user']);
            $password = sanitize($_POST['password']);
            connection($username, $password);
            $user = $_SESSION['user'];
            if($user){
                header('Location: /user?ac=profil');
                exit();
            }
            if(!$user){
                $error = "Login ou mot de passe incorrect";
                include (__DIR__.'/../View/connection.php');
            }
        }
        break;

    case 'logout':
        unset($_SESSION['user']);
        header('Location: /user?ac=login');
        exit();
        break;

    case 'adduser':
        include (__DIR__.'/../View/adduser.php');
        break;

    case 'createuser':
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);
        $conf_pass = sanitize($_POST['conf_pass']);
        $add = addUser($username, $password, $conf_pass);
        if ($add['create']){
            connection($username, $password);
            header('Location: /user?ac=profil');
            exit();
        }
        if (!$add['create']){
            $error = $add['message'];
            include (__DIR__.'/../View/adduser.php');
        }
        break;

    case 'setuser':
        if(isset($_SESSION['user'])){
           $user = $_SESSION['user'];
            include (__DIR__.'/../View/setuser.php');
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'setlogin':
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $username = sanitize($_POST['login']);
            $set = setLogin($user->id, $username);
            if ($set['create']) {
                header('Location: /user?ac=profil');
                exit();
            }
            if (!$set['create']) {
                $errorlogin = $set['message'];
                include(__DIR__ . '/../View/setuser.php');
            }
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
        break;

    case 'setpassword':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            $password = sanitize($_POST['password']);
            $conf_pass = sanitize($_POST['conf_pass']);
            $set = setPassword($user->id, $password, $conf_pass);
            if ($set['create']){
                header('Location: /user?ac=profil');
                exit();
            }
            if (!$set['create']){
                $errorpass = $set['message'];
                include (__DIR__.'/../View/setuser.php');
            }
        }
        if(!isset($_SESSION['user'])){
            header('Location: /user?ac=login');
            exit();
        }
}

