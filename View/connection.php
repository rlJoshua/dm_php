<div class="title">Connection</div>
<form action="http://192.168.99.101/user?ac=profil" method="post">
    <label for="user">Login</label><br />
    <input class="i-username" type="text" name="user" required/>
    <br />
    <label for="password">Mot de passe</label><br />
    <input class="i-password" type="password" name="password" required/>
    <br />
    <input class="i-sub" type="submit" value="Se connecter">
</form>
<?php
if (isset($error)){
    echo $error;
}