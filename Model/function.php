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


//Users functions

/**
 * @param $username
 * @param $password
 * @uses connectUser()
 * Get user data
 */
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

/**
 * @param $user
 * @param $password
 * Connect user by creating a session
 */
function connectUser($user, $password){
    if($user){
        if(password_verify($password, $user->password)){
            unset($user->password);
            $_SESSION['user'] = $user;

        }
    }
}

/**
 * @param $username
 * @param $password
 * @param $conf_pass
 * @return object
 */
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

/**
 * @param $username
 * @return object
 */
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

/**
 * @param $id
 * @param $username
 * @return object
 */
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

/**
 * @param $id
 * @param $password
 * @param $conf_pass
 * @return object
 */
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



//Posts functions

/**
 * @param $page
 * @return array
 */
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

/**
 * @param $id
 * @return object
 */
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

/**
 * @param $title
 * @param $image
 * @param $content
 * @param $category
 * @param $idPost
 * @return object
 *
 */
function setPost($title, $image, $content, $category, $idPost){
    $pdo = connectPdo();
    $imagePath = getImagePath($idPost);
    if(!empty($image['name'])){
        $imagePath = getImageNewPath($idPost, $image['name']);
    }

    $path = dirname(dirname(__FILE__)) . '/asset/img';

    try{
        $db = $pdo->prepare("update posts 
        set posts.title = :title, posts.imagePath = :image, posts.content = :content, posts.idCategory = :category
        where posts.id = :idPost");
        $db->execute([':title' => $title, ':image'=>$imagePath, ':content'=>$content, ':category'=>$category, ':idPost'=>$idPost]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
    $post = getPostById($idPost);
    move_uploaded_file($image['tmp_name'], $path."/".$imagePath);
    return $post;
}

/**
 * @param $title
 * @param $img
 * @param $content
 * @param $category
 * @param $idUser
 */
function addPost($title, $img, $content, $category, $idUser){
    $pdo = connectPdo();
    $imagePath = addImagePath($img['name']);
    $path = dirname(dirname(__FILE__)) . '/asset/img';
    try{
        $db = $pdo->prepare("insert into posts (imagePath, title, content, idCategory, idUser) values
        (:imagePath, :title, :content, :idCategory, :idUser)");
        $db->execute([':imagePath' => $imagePath, ':title' => $title, ':content'=>$content, ':idCategory'=>$category, ':idUser'=>$idUser]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
    move_uploaded_file($img['tmp_name'], $path."/".$imagePath);
}

/**
 * @param $image
 * @return string
 * Create path image for new post
 */
function addImagePath($image){
    $pdo = connectPdo();
    $path = dirname(dirname(__FILE__)) . '/asset/img';
    try{
        $db = $pdo->prepare("SELECT max(id) imagePath FROM posts ORDER by id DESC");
        $db->execute();
        $req = $db->fetch(PDO::FETCH_OBJ);
        $exp = explode("/",$req->imagePath);
        $id = $exp[0] + 1;
        if(!is_dir($path."/".$id)){
            mkdir($path."/".$id);
        }
        $img = $id."/".$image;
        return $img;
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

/**
 * @param $idPost
 * @return object
 */
function getImagePath($idPost){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("SELECT imagePath FROM posts where posts.id = :id");
        $db->execute([':id'=>$idPost]);
        $req = $db->fetch(PDO::FETCH_OBJ);
        $img = $req->imagePath;
        return $img;
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }

}

/**
 * @param $idPost
 * @param $image
 * @return string
 * Delete image in dir and create a dir if this is don't exist
 */
function getImageNewPath($idPost, $image){
    $pdo = connectPdo();
    $path = dirname(dirname(__FILE__)) . '/asset/img';
    try{
        $db = $pdo->prepare("SELECT imagePath FROM posts where posts.id = :id");
        $db->execute([':id'=>$idPost]);
        $req = $db->fetch(PDO::FETCH_OBJ);
        $exp = explode("/",$req->imagePath);
        $id = $exp[0];
        if(is_dir($path."/".$id)){
            $files = dirToArray($path."/".$id);
            foreach ($files as $file){
                unlink($path."/".$id."/".$file);
            }
        }
        if(!is_dir($path."/".$id)){
            mkdir($path."/".$id);
        }

        $img = $id."/".$image;
        return $img;
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }

}

/**
 * @param $dir
 * @return array
 * Get all file on dir
 */
function dirToArray($dir) {

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {
                $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            }
            else
            {
                $result[] = $value;
            }
        }
    }

    return $result;
}

/**
 * @return int
 */
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

/**
 * @param $idPost
 */
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


//Comments functions

/**
 * @param $idPost
 * @return array
 */
function getCommentsByPost($idPost){
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

/**
 * @param $id
 * @return mixed
 */
function getComment($id){
    $pdo = connectPdo();
    try{

        $db = $pdo->prepare("select comments.id, comments.content, comments.idUser, comments.idPost, users.username as username
        from comments LEFT JOIN users ON comments.idUser = users.id 
        WHERE comments.id = :id");
        $db->execute([':id'=>$id]);
        $comment = $db->fetch(PDO::FETCH_OBJ);
        return $comment;
    }catch (PDOException $e){
        echo"Erreur de connexion". $e->getMessage();
    }
}

/**
 * @param $content
 * @param $idPost
 * @param $idUser
 */
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

/**
 * @param $id
 */
function deleteComment($id){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("delete FROM comments WHERE comments.id = :id");
        $db->execute([':id' => $id]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

/**
 * @param $idPost
 */
function deleteCommentsByPost($idPost){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("delete FROM comments WHERE comments.idPost = :idPost");
        $db->execute([':idPost' => $idPost]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}


//Admin functions

/**
 * @return array
 */
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

/**
 * @param $name
 */
function addCategory($name){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("insert into categories (categories.name) values (:name)");
        $db->execute([':name' => $name]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

/**
 * @param $id
 * @param $name
 */
function setCategory($id, $name){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("update categories set categories.name = :namecat where categories.id = :id ");
        $db->execute([':namecat' => $name, ':id'=>$id]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}

/**
 * @param $id
 * @return object
 */
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

/**
 * @param $idCategory
 */
function deleteCategory($idCategory){
    $pdo = connectPdo();
    try{
        $db = $pdo->prepare("delete FROM categories WHERE categories.id = :idCategory");
        $db->execute([':idCategory' => $idCategory]);
    }catch (PDOException $e){
        echo "Erreur de connection". $e->getMessage();
    }
}


//Others functions

/**
 * @param $idUser
 * @param $id
 * @return bool
 * Verif if connected user have authorization to links
 */
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

/**
 * @param $page
 * @return bool
 * Secure GET page for posts pagination
 */
function getLedgitPage($page){
    $authorize = false;
    if(isset($page) && !empty($page) && $page>0){
        $authorize = true;
    }
    if(!isset($page) || empty($page)){
        $authorize = false;
    }

    return $authorize;
}

/**
 * @param $input
 * @return string
 * Secure input html and trim
 */
function sanitize($input): string
{
    $input = trim($input);
    return htmlspecialchars($input);
}