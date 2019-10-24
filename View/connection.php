<div class="title">Connection</div>
<form action="/user?ac=profil" method="post">
    <label for="user">Login</label><br />
    <input class="i-username" type="text" name="user" required/>
    <br />
    <label for="password">Mot de passe</label><br />
    <input class="i-password" type="password" name="password" required/>
    <br />
    <a href="/user?ac=adduser">S'incrire</a><br />
    <input class="i-sub" type="submit" value="Se connecter">
</form>
<?php
if (isset($error)){
    echo $error;
}