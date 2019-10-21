<?php
include(__DIR__.'/../Model/function.php');
$action = $_REQUEST['ac'];

switch ($action) {

    case 'display':
        $posts = getAllPosts();
        include(__DIR__.'/../View/post.php');
        break;

}






