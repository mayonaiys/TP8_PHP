<?php

include 'connexpdo.php';

//Connexion à la base de donnée
$bdd = connexpdo('pgsql:dbname=citations;host=localhost;port=5432','postgres','passwordbdd');

//Récupération & affichage du nom et prénom des auteurs
$query1 = "SELECT nom,prenom FROM auteur;";
$result1 = $bdd->query($query1);

echo '<h1>Auteurs de la BD</h1>';

foreach ($result1 as $data){
    echo $data['nom'].' '.$data['prenom'].'<br>';
}

//Récupération des citations
$query2 = "SELECT phrase FROM citation";
$result2 = $bdd->query($query2);

echo '<h1>Citations de la BD</h1>';

foreach ($result2 as $data){
    echo $data['phrase'].'<br>';
}

//Récupération des siecles de la BD
$query3 = "SELECT numero FROM siecle;";
$result3 = $bdd->query($query3);

echo '<h1>Siecles de la BD</h1>';

foreach ($result3 as $data){
    echo $data['numero'].'<br>';
}