<?php
function connectPdo(){
    try{
        $pdo = new PDO ('mysql:host='.HOST.';dbname='.DBNAME, USER , PW ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        return $pdo ;
    }
    catch(PDOExeption $e)
    {
        echo "problème de connexion". $e->getMessage();
        return fasle ;
    }
}