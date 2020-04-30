<?php

function connexpdo($base,$user,$password){
    try {
        $dbh = new PDO($base,$user,$password);
        return $dbh;
    } catch (PDOException $exception){
        echo 'Connexion échouée : '.$exception->getMessage();
        return 0;
    }
}