<?php
    include ('view/header.php');
?>
<div class="title" xmlns="http://www.w3.org/1999/html">Modifier votre Nom d'utilisateur</div>
<form class="i-form" action="/user?ac=setlogin" id="setlogin" method="post">
    <label for="login">Nouveau nom d'utilisateur</label><br />
    <input class="i-login" type="text" value="<?php echo $user->username?>" name="login" required/>
    <br />
    <br />
    <input class="i-sub" form="setlogin" type="submit" value="Modifier login">
</form>
<?php
if (isset($errorlogin)){
    echo $errorlogin;
}
?>
<br />
<br />

<div class="title" xmlns="http://www.w3.org/1999/html">Modifier votre mot de passe</div>
<form class="i-form" action="/user?ac=setpassword" id="setpass" method="post">
    <label for="password">Nouveau mot de passe</label><br />
    <input class="i-password" type="password" name="password" required>
    <br />
    <label for="conf_pass">Confirmer nouveau mot de passe</label><br />
    <input class="i-password" type="password" name="conf_pass" required>
    <br />
    <br />
    <input class="i-sub" form="setpass" type="submit" value="Modifier mot de passe">
</form>

<?php
if (isset($errorpass)){
    echo $errorpass;
}