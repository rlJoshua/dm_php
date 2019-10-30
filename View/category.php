<?php
    include ('view/header.php');
?>
<title>Blog - Category</title>
<?php

if(isset($categories)){
    foreach ($categories as $category){
    ?>
    <div class='comment'><?php echo "$category->id : $category->name"; ?>
        <a class='supprcat' onclick="return confirmSuppr()" href= <?php echo "/admin?ac=deletecategory&id=$category->id" ?>>Supprimer</a>
    </div>
    <?php
    }
    if(isset($message)){
        echo "<div class='msg'>$message</div>";
    }

}
?>
<div class="title" xmlns="http://www.w3.org/1999/html">Ajouter une Catégorie</div>

<form action="/admin?ac=addcategory" id="addcat" method="post" >
    <label for="name">Nouvelle catégorie</label><br />
    <input class="i-title" type="text" name="name" required/>
    <br />
    <br />
    <input class="i-sub" form="addcat" type="submit" value="Créer une catégorie">
</form>

<div class="title" xmlns="http://www.w3.org/1999/html">Modifier une Catégorie</div>

<form action="/admin?ac=setcategory" id="setcat" method="post" >
    <label for="idcategory">Nouveau nom de catégorie</label><br />
    <select class="i-category" type="select" form="setcat" name="idcat">
        <?php
        foreach ($categories as $category){
            echo "<option value=$category->id>$category->name</option>";
        }
        ?>
    </select>
    <input class="i-title" type="text" name="namecat" required/>
    <br />
    <br />
    <input class="i-sub" form="setcat" type="submit" value="Modifir la catégorie">
</form>