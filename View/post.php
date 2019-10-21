<title>Blog - Posts</title>


<?php
    foreach ($posts as $post){
        echo "<div class='posts'>";
            echo "<div class='p-title'>$post->title</div>";
            echo "<div class='p-img'>$post->imagePath</div>";
            echo "<div class='p-content'>$post->content</div>";
            echo "<div class='p-category'>$post->categoryname</div>";
            echo "<div class='p-username'>Publier par $post->username</div>";
        echo "</div>";
    }