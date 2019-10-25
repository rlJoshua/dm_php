<title>Blog - Posts</title>
<div class="title" xmlns="http://www.w3.org/1999/html">Modifier un article</div>

<form action="/posts?ac=updatepost" id="form-setpost" method="post" enctype="multipart/form-data">
    <label for="title">Titre</label><br />
    <input class="i-title" type="text" name="title" value="<?php echo $post->title?>" required/>
    <br />
    <label for="content">Contenue</label><br />
    <textarea class="i-content" name="content" required><?php echo $post->content?></textarea>
    <br />
    <label for="category">Catégories</label><br />
    <select class="i-category" type="select" form="form-setpost" name="category">
        <?php
        foreach ($categories as $category){
            if($post->idCategory === $category->id){
                echo "<option value=$category->id selected>$category->name</option>";
            }
            if($post->idCategory !== $category->id) {
                echo "<option value=$category->id>$category->name</option>";
            }
        }
        ?>
    </select>
    <br />
    <br />
    <input type="hidden" value="<?php echo $post->id?>" name="idPost">
    <input class="i-sub" type="submit" value="Modifier l'article">
</form>
<?php
if (isset($error)){
    echo $error;
}