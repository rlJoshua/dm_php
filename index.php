<?php
if(PHP_SESSION_NONE === session_status()){
    session_start();
}

$request = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $request = explode('?', $_SERVER['REQUEST_URI']);
    $request = $request[0];
}
if($request === '/'){
    $request = '/posts';
}


switch ($request){
    case '/posts':
        include('Controler/postsControler.php');
        break;

    case '/user':
        include('Controler/usersControler.php');
        break;

    case '/admin':
        include('Controler/adminControler.php');
        break;

}


include('view/footer.php');