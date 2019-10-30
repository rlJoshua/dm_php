<?php
    include ('view/header.php');
?>
<title>Blog - Profile</title>
<div class="title" xmlns="http://www.w3.org/1999/html">Profil</div>
<?php
if(isset($user)){
    echo "Username : $user->username";
?>
    <br />
    <br />
    <a class="supprcat" href="/user?ac=setuser">Modifier profil</a>

    <div class="title" xmlns="http://www.w3.org/1999/html">Vos articles</div>
    <?php
    if(isset($posts)) {
        foreach ($posts as $post) {
            ?>
            <div class='comment'>
                <img class='l-img img-thumbnail' src="<?php echo "../asset/img/".$post->imagePath?>">
                <div class='p-title'><?php echo $post->title ?></div>
                <div class='l-content'><?php echo $post->content?></div>
                <div class='p-category'><?php echo "Catégorie : $post->categoryname" ?></div>
                <?php
                ?><a class='p-link' href=<?php echo "/posts?ac=display&id=$post->id" ?>>Voir</a>
            </div>
            <?php
        }
    }
    if(empty($posts)){
        echo "<div>Vous avez aucun article</div>";
    }
}

