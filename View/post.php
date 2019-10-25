<title>Blog - Posts</title>


<?php
    if(isset($posts)){
        echo "<div class='title' xmlns='http://www.w3.org/1999/html'>Articles</div>";
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
        echo "<div class='v-posts'>";
        echo "<div class='v-title'>$postv->title</div>";
        echo "<div class='v-img'>$postv->imagePath</div>";
        echo "<div class='v-category'>$postv->categoryname</div>";
        echo "<div class='v-content'>$postv->content</div>";
        echo "<div class='v-username'>Publier par $postv->username</div>";
        if($authorize){
            ?><a href=<?php echo "/posts?ac=setpost&id=$postv->id";?> class='p-link'>Modifier l'article</a><?php
        }
        echo "</div>";
        ?>
        <div class="comments">
            <div class="P-title">Commentaires :</div>
            <?php
            if (isset($comments)){
                foreach ($comments as $comment){
                    echo "<div class='comment'>";
                    echo "<div class='p-content'>$comment->content</div>";
                    echo "<div class='p-username'>De $comment->username</div>";
                    echo "</div>";
                }
            }
            ?>
        </div>
        <form action="/posts?ac=addcomment" id="form-addcomment" method="post" >
            <textarea class="c-content" name="content" required placeholder="Commentaire"></textarea>
            <input type="hidden" value="<?php echo $postv->id?>" name="idPost">
            <input class="i-sub c-sub" type="submit" value="Commenter">
        </form>
        <?php
    }
