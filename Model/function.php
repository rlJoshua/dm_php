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

function getPosts($page){
    $pdo = connectPdo();
    $nbp = 10;
    $start = ($page-1)*$nbp;
    try{
        $db = $pdo->prepare("select posts.id, posts.imagePath, posts.title, posts.content, idCategory, 
        categories.name as categoryname, idUser, users.username  as username
        from posts LEFT JOIN categories on posts.idCategory = categories.id 
        LEFT JOIN users on idUser = users.id ORDER BY posts.id DESC LIMIT :start, :nbp");
        $db->bindParam(':start', $start, PDO::PARAM_INT);
        $db->bindParam(':nbp', $nbp, PDO::PARAM_INT);
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

function setLogin($id, $username){
    $pdo = connectPdo();
    $testuser = getUserByName($username);
    if($testuser === null) {
        try {
            $db = $pdo->prepare("update users set users.username = :username where users.id = :id");
            $db->execute([':username' => $username, ':id' => $id]);
            $_SESSION['user']->username = $username;
            $msg['create'] = true;
            return $msg;
        } catch (PDOException $e) {
            echo "Erreur de connection" . $e->getMessage();
        }
    }
    if($testuser !== null){
        $msg['create'] = false;
        $msg['message'] = "Le Login existe déjà";
        return $msg;
    }
}

function setPassword($id, $password, $conf_pass){
    if($password === $conf_pass){
        $pdo = connectPdo();
        $password = password_hash($password, PASSWORD_DEFAULT);
        try{
            $db = $pdo->prepare("update users set users.password = :password 
        where users.id = :id");
            $db->execute([':password' => $password, ':id'=>$id]);
            $msg['create'] = true;
            return $msg;
        }catch (PDOException $e){
            echo "Erreur de connection". $e->getMessage();
        }
    }
    if($password !== $conf_pass){
        $msg['create'] = false;
        $msg['message'] = "Les mots de passe sont différents";
        return $msg;
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

function getNbPosts(){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("select posts.id from posts");
        $db->execute();
        $count = $db->rowCount();
        return $count;
    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
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

function addCategory($name){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("insert into categories (categories.name) values (:name)");
        $db->execute([':name' => $name]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function setCategory($id, $name){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("update categories set categories.name = :namecat where categories.id = :id ");
        $db->execute([':namecat' => $name, ':id'=>$id]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function getCategoryNameById($id){
    $pdo = connectPdo();
    try {
        $db = $pdo->prepare(" SELECT categories.name FROM categories where categories.id=:id");
        $db->execute([':id'=>$id]);
        $req = $db->fetch(PDO::FETCH_OBJ);
        return $req->name;
    }catch (PDOException $e){
        echo "Erreur de connection users". $e->getMessage();
    }
}

function deleteCategory($idCategory){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("delete FROM categories WHERE categories.id = :idCategory");
        $db->execute([':idCategory' => $idCategory]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function deletePost($idPost){
    $pdo = connectPdo();
    deleteCommentsByPost($idPost);
    try{
        $db = $pdo->prepare("delete FROM posts WHERE posts.id = :idPost");
        $db->execute([':idPost' => $idPost]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

function deleteCommentsByPost($idPost){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("delete FROM comments WHERE comments.idPost = :idPost");
        $db->execute([':idPost' => $idPost]);
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

function getLedgitPage($page){
    $authorize = false;
    if(isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0){
        $authorize = true;
    }
    if(!isset($_REQUEST['page']) || empty($_REQUEST['page'])){
        $authorize = false;
    }

    return $authorize;
}

function sanitize($input): string
{
    $input = trim($input);
    return htmlspecialchars($input);
}