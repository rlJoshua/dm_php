<title>Blog - Posts</title>


<?php
    if(isset($posts)){
        echo "<div class='title' xmlns='http://www.w3.org/1999/html'>Articles</div>";
        foreach ($posts as $post){
            ?>
            <div class='posts'>
                <div class='p-title'><?php echo $post->title ?></div>
                <div class='p-img'><?php echo $post->imagePath?></div>
                <div class='p-content'><?php echo $post->content?></div>
                <div class='p-category'><?php echo $post->categoryname?></div>
                <div class='p-username'>Publier par <?php echo $post->username?></div>
                <a href='<?php echo "/posts?ac=display&id=$post->id";?>' class='p-link'>Lire</a>
            </div>
        <?php
        }
        ?>
        <nav class="p-pagination" aria-label="...">
            <ul class="pagination pagination-lg">
            <?php
            for ($count = 1; $nbpages>=$count; $count++) {
                ?>
                <li class="page-item">
                    <a class="page-link" href=<?php echo "/posts?ac=display&page=$count" ?> >
                        <?php echo $count; ?>
                    </a>
                </li>
                <?php
            }
            ?>
            </ul>
        </nav>
    <?php
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
