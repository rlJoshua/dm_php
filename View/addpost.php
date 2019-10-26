<title>Blog - Posts</title>
<div class="title" xmlns="http://www.w3.org/1999/html">Ajouter un article</div>

<form action="/posts?ac=createpost" id="form-addpost" method="post" enctype="multipart/form-data">
    <label for="title">Titre</label><br />
    <input class="i-title" type="text" name="title" required/>
    <br />
    <label for="content">Contenue</label><br />
    <textarea class="i-content" name="content" required></textarea>
    <br />
    <label for="category">Catégories</label><br />
    <select class="i-category" type="select" form="form-addpost" name="category">
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