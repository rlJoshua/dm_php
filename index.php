<?php

$request = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $request = explode('?', $_SERVER['REQUEST_URI']);
    $request = $request[0];
}

include ('view/header.php');

switch ($request){
    case '/posts':
        include('Controler/postsControler.php');
        break;

    case '/user':
        include('Controler/usersControler.php');
        break;

}





include('view/footer.php');