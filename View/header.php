<?php

?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible">

    <!-- Link CSS Icons -->
    <link href="asset/css/bootstrap.min.css" rel ="stylesheet">
    <link rel="stylesheet" type="text/css" href="asset/css/style.css?v=1">

    <!-- Link Police Icons -->
    <link rel="stylesheet" href="{{url('https://use.fontawesome.com/releases/v5.2.0/css/all.css')}}" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- Link Script -->
    <script src="asset/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/posts?ac=display">Articles<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/posts?ac=addpost">Créer un article</a>
            </li>
            <?php
            if(!isset($_SESSION['user'])){
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user?ac=login">Connexion</a>
                </li>
            <?php
            }
            ?>
            <?php
            if(isset($_SESSION['user'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user?ac=profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user?ac=logout">Deconnection</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>