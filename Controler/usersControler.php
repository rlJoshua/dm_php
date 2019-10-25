<?php

include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'login':
        include(__DIR__.'/../View/connection.php');
        break;

    case 'profil':
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
            include (__DIR__.'/../View/profil.php');
        }
        if(isset($_REQUEST['user'])){
            $username = sanitize($_REQUEST['user']);
            $password = sanitize($_REQUEST['password']);
            connection($username, $password);
            $user = $_SESSION['user'];
            if($user){
                include (__DIR__.'/../View/profil.php');
            }
            if(!$user){
                $error = "Login ou mot de passe incorrect";
                include (__DIR__.'/../View/connection.php');
            }
        }
        break;

    case 'logout':
        unset($_SESSION['user']);
        break;

    case 'adduser':
        include (__DIR__.'/../View/adduser.php');
        break;

    case 'createuser':
        $username = sanitize($_REQUEST['username']);
        $password = sanitize($_REQUEST['password']);
        $conf_pass = sanitize($_REQUEST['conf_pass']);
        $add = addUser($username, $password, $conf_pass);
        if ($add['create']){
            include (__DIR__.'/../View/profil.php');
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
            include (__DIR__.'/../View/connection.php');
        }
        break;

    case 'setlogin':
        $user = $_SESSION['user'];
        $username = sanitize($_REQUEST['login']);
        $set = setLogin($user->id, $username);
        if ($set['create']){
            include (__DIR__.'/../View/profil.php');
        }
        if (!$set['create']){
            $errorlogin = $set['message'];
            include (__DIR__.'/../View/setuser.php');
        }
        break;

    case 'setpassword':
        $user = $_SESSION['user'];
        $password = sanitize($_REQUEST['password']);
        $conf_pass = sanitize($_REQUEST['conf_pass']);
        $set = setPassword($user->id, $password, $conf_pass);
        if ($set['create']){
            include (__DIR__.'/../View/profil.php');
        }
        if (!$set['create']){
            $errorpass = $set['message'];
            include (__DIR__.'/../View/setuser.php');
        }
}

