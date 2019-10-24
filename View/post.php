<title>Blog - Posts</title>


<?php
    if(isset($posts)){
        foreach ($posts as $post){
            echo "<div class='posts'>";
            echo "<div class='p-title'>$post->title</div>";
            echo "<div class='p-img'>$post->imagePath</div>";
            echo "<div class='p-content'>$post->content</div>";
            echo "<div class='p-category'>$post->categoryname</div>";
            echo "<div class='p-username'>Publier par $post->username</div>";
            ?><a href= <?php echo "/posts?ac=display&id=$post->id";?> class='p-link'>Lire</a><?php
            echo "</div>";
        }
    }
    if (isset($postv)){
        echo "<div class='posts'>";
        echo "<div class='p-title'>$postv->title</div>";
        echo "<div class='p-img'>$postv->imagePath</div>";
        echo "<div class='p-content'>$postv->content</div>";
        echo "<div class='p-category'>$postv->categoryname</div>";
        echo "<div class='p-username'>Publier par $postv->username</div>";
        if($user->username === $postv->username || $user->id === "1"){
            ?><a href=<?php echo "/posts?ac=setpost&id=$postv->id";?> class='p-link'>Modifier</a><?php
        }
        echo "</div>";
    }
