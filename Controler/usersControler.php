<?php

include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'connection':
        $posts = getAllPosts();
        include(__DIR__.'/../View/connection.php');
        break;

    case 'profil':
        if(isset($_REQUEST['user'])){
            $username = $_REQUEST['user'];
            $password = $_REQUEST['password'];
            connection($username, $password);

        }
        break;
}

