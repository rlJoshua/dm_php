<?php
    include ('view/header.php');
?>
<title>Blog - Subscribe</title>
<div class="title" xmlns="http://www.w3.org/1999/html">Inscription</div>

<form class="i-form" action="/user?ac=createuser" id="form-addpost" method="post" enctype="multipart/form-data">
    <label for="username">Login</label><br />
    <input class="i-login" type="text" name="username" required/>
    <br />
    <label for="password">Mot de passe</label><br />
    <input class="i-password" type="password" name="password" required>
    <br />
    <label for="conf_pass">Confirmer mot de passe</label><br />
    <input class="i-password" type="password" name="conf_pass" required>
    <br />
    <br />
    <input class="i-sub" type="submit" value="S'inscrire">
</form>
<?php
if (isset($error)){
    echo $error;
}