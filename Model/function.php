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
        LEFT JOIN users on idUser = users.id");
        $db->execute();
        $posts = $db->fetchALL(PDO::FETCH_OBJ);

    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }


    return $posts;
}

function connection($username, $password){
    $pdo = connectPdo();

    try{
        $db = $pdo->prepare("select users.id, users.username from users 
        where users.username = :username and users.password = :password");
        $db->execute([':username' => $username, ':password' => $password]);
        $user = $db->fetch(PDO::FETCH_OBJ);
        connectUser($user);
    }catch (PDOException $e){
        echo "Erreur de connection users". $e->getMessage();
    }
}

function connectUser($user){
    if($user){
        $_SESSION['user'] = $user;
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

}