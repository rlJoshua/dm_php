<title>Blog - Posts</title>


<?php
    if(isset($posts)){
        echo "<div class='title' xmlns='http://www.w3.org/1999/html'>Articles</div>";
        foreach ($posts as $post){
            ?>
            <div class='posts'>
                <img class='p-img img-thumbnail' src="<?php echo "../asset/img/".$post->imagePath?>">
                <div class='p-title'><?php echo $post->title ?></div>
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
        ?>
        <div class='v-posts'>
        <div class='v-title'><?php echo $postv->title ?></div>
        <img class='v-img img-fluid' alt='Responsive image' src='<?php echo"../asset/img/$postv->imagePath" ?>'>
        <div class='v-category'><?php echo "Catégorie : $postv->categoryname" ?></div>
        <div class='v-content'><?php echo str_replace('\n\'', '<br/>', nl2br($postv->content)) ?></div>
        <div class='v-username'>Publier par <?php echo $postv->username ?> </div>
        <?php
        if($authorize){
            ?><a class='p-link' href=<?php echo "/posts?ac=setpost&id=$postv->id"?> >Modifier l'article</a><?php
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
