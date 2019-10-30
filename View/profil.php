<?php
    include ('view/header.php');
?>
<title>Blog - Profile</title>
<div class="title" xmlns="http://www.w3.org/1999/html">Profil</div>
<?php
if(isset($user)){
    echo "Username : $user->username";
?>
    <br />
    <br />
    <a class="supprcat" href="/user?ac=setuser">Modifier profil</a>
<?php
}

