<div class="title" xmlns="http://www.w3.org/1999/html">Ajout de posts</div>

<form action="http://192.168.99.101/posts?ac=createpost" id="form-addpost" method="post">
    <label for="title">Titre</label><br />
    <input class="i-title" type="text" name="title" required/>
    <br />
    <label for="content">Contenue</label><br />
    <textarea class="i-password" name="content" required></textarea>
    <br />
    <label for="category">Catégories</label><br />
    <select class="i-title" type="select" form="form-addpost" name="category">
        <?php
        foreach ($categories as $category){
            echo "<option value=$category->id>$category->name</option>";
        }
        ?>
    </select>
    <br />
    <br />
    <input type="file" name="image" accept=".jpg, .jpeg, .png"/><br />

    <input class="i-sub" type="submit" value="Créer un article">
</form>
<?php
if (isset($error)){
    echo $error;
}