<?php

require (__DIR__.'/../config/config.php');



/**
 * Fonction permettant de se connecter à la base de donnees
 * @return PDO
 */
function connectPdo(){
    try{
        $pdo = new PDO ('mysql:host='.HOST.';dbname='.DBNAME, USER , PW , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        return $pdo ;
    }
    catch(PDOExeption $e)
    {
        echo "problème de connexion". $e->getMessage();
        return fasle ;
    }
}

function getPosts(){

    $pdo = connectPdo();
    try{

        $db = $pdo->prepare("select posts.id, posts.imagePath, posts.title, posts.content, idCategory, 
        categories.name as categoryname, idUser, users.username  as username
        from posts LEFT JOIN categories on posts.idCategory = categories.id 
        LEFT JOIN users on idUser = users.id ORDER BY posts.id DESC");
        $db->execute();
        $posts = $db->fetchALL(PDO::FETCH_OBJ);
        return $posts;
    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }
}

function getPostById($id){
    $pdo = connectPdo();
    try {
        $db = $pdo->prepare(" SELECT posts.id, posts.imagePath, posts.title, posts.content, idCategory, 
        categories.name as categoryname, idUser, users.username as username 
        from posts LEFT JOIN categories on posts.idCategory = categories.id 
        LEFT JOIN users on idUser = users.id WHERE posts.id = :id");
        $db->execute([':id'=>$id]);
        $post = $db->fetch(PDO::FETCH_OBJ);
        return $post;
    }catch (PDOException $e){
        echo "Erreur de connection users". $e->getMessage();
    }
}

function connection($username, $password){
    $pdo = connectPdo();

    try{
        $db = $pdo->prepare("select * from users where users.username = :username");
        $db->execute([':username' => $username]);
        $user = $db->fetch(PDO::FETCH_OBJ);
        connectUser($user, $password);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function connectUser($user, $password){
    if($user){
        if(password_verify($password, $user->password)){
            unset($user->password);
            $_SESSION['user'] = $user;
        }
    }
}

function getCategories(){

    $pdo = connectPdo();
    try{

        $db = $pdo->prepare("select categories.id, categories.name from categories");
        $db->execute();
        $categories = $db->fetchALL(PDO::FETCH_OBJ);

    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }

    return $categories;
}

function addPost($title, $img, $content, $category, $idUser){
    $pdo = connectPdo();
    $img = getPathimage($img);
    try{
        $db = $pdo->prepare("insert into posts (imagePath, title, content, idCategory, idUser) values
        (:imagePath, :title, :content, :idCategory, :idUser)");
        $db->execute([':imagePath' => $img, ':title' => $title, ':content'=>$content, ':idCategory'=>$category, ':idUser'=>$idUser]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
    $path = __DIR__.'/../asset/img/';
    move_uploaded_file($img, $path);
}

function getPathimage($image){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare(" SELECT imagePath FROM posts");
        $db->execute();
        $req = $db->fetch(PDO::FETCH_OBJ);
        $exp = explode("/",$req->imagePath);
        $id = $exp[0] + 1;
        $img=$id."/".$image;
        return $img;
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function addUser($username, $password, $conf_pass){
    if($password === $conf_pass){
        $pdo = connectPdo();
        $testuser = getUserByName($username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        if($testuser === null){
            try{
                $db = $pdo->prepare("insert into users (username, password) values (:username, :password)");
                $db->execute([':username' => $username, ':password' => $password]);
                connection($username, $password);
                $msg['create'] = true;
                return $msg;
            }catch (PDOException $e){
                echo "Erreur de connection". $e->getMessage();
            }
        }
        if($testuser !== null){
            $msg['create'] = false;
            $msg['message'] = "Le Login existe déjà";
            return $msg;
        }
    }
    if($password !== $conf_pass){
        $msg['create'] = false;
        $msg['message'] = "Les mots de passe sont différents";
        return $msg;
    }
}

function getUserByName($username){
    $pdo = connectPdo();
    try {
        $db = $pdo->prepare(" SELECT username FROM users where username=:username");
        $db->execute([':username'=>$username]);
        $req = $db->fetch(PDO::FETCH_OBJ);
        return $req->username;
    }catch (PDOException $e){
        echo "Erreur de connection users". $e->getMessage();
    }
}

function setPassword($id,$username, $password){
    $pdo = connectPdo();
    $password = password_hash($password, PASSWORD_DEFAULT);
    try{
        $db = $pdo->prepare("update users set users.password = :newpass 
        where users.username = :username and users.id = :id");
        $db->execute([':newpass' => $password, ':username'=>$username, ':id'=>$id]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function setPost($title, $content, $category, $idPost){
    $pdo = connectPdo();

    try{
        $db = $pdo->prepare("update posts 
        set posts.title = :title, posts.content = :content, posts.idCategory = :category
        where posts.id = :idPost");
        $db->execute([':title' => $title, ':content'=>$content, ':category'=>$category, ':idPost'=>$idPost]);
        $post = getPostById($idPost);
        return $post;
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function getComments($idPost){
    $pdo = connectPdo();
    try{

        $db = $pdo->prepare("select comments.id, comments.content, comments.idUser, users.username as username
        from comments LEFT JOIN users ON comments.idUser = users.id 
        WHERE comments.idPost = :idPost ORDER BY id");
        $db->execute([':idPost'=>$idPost]);
        $comments = $db->fetchALL(PDO::FETCH_OBJ);
        return $comments;
    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }
}

function addComment($content, $idPost, $idUser){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("insert into comments (content, idPost, idUser) 
        values (:content, :idPost, :idUser)");
        $db->execute([':content' => $content, ':idPost' => $idPost, ':idUser'=>$idUser]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function getAuthorize($idUser, $id){
    $authorize = false;

    if($idUser === $id){
        $authorize = true;
    }
    if ($idUser !== $id){
        $authorize = false;
    }
    if ($idUser === "1"){
        $authorize = true;
    }
    return $authorize;
}

function sanitize($input): string
{
    $input = trim($input);
    return htmlspecialchars($input);
}