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
            $username = $_REQUEST['user'];
            $password = $_REQUEST['password'];
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
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $conf_pass = $_REQUEST['conf_pass'];
        $add = addUser($username, $password, $conf_pass);
        if ($add['create']){
            include (__DIR__.'/../View/profil.php');
        }
        if (!$add['create']){
            $error = $add['message'];
            include (__DIR__.'/../View/adduser.php');
        }
        break;

}

