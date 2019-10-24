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

function getAllPosts(){

    $pdo = connectPdo();
    try{

        $db = $pdo->prepare("select posts.id, posts.imagePath, posts.title, posts.content, idCategory, 
        categories.name as categoryname, idUser, users.username 
        from posts LEFT JOIN categories on posts.idCategory = categories.id 
        LEFT JOIN users on idUser = users.id ORDER BY posts.id DESC");
        $db->execute();
        $posts = $db->fetchALL(PDO::FETCH_OBJ);

    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }


    return $posts;
}

function getPostById($id){
    $pdo = connectPdo();
    try {
        $db = $pdo->prepare(" SELECT posts.id, posts.imagePath, posts.title, posts.content, idCategory, 
        categories.name as categoryname, idUser, users.username 
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

function getAllCategories(){

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

function addPost($title, $img, $content, $category, $user){
    $pdo = connectPdo();
    $img = getPathimage($img);
    try{
        $db = $pdo->prepare("insert into posts (imagePath, title, content, idCategory, idUser) values
        (:imagePath, :title, :content, :idCategory, :idUser)");
        $db->execute([':imagePath' => $img, ':title' => $title, ':content'=>$content, ':idCategory'=>$category, ':idUser'=>$user]);
        connectUser($user);
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