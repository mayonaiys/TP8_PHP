<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="#">Informations</a>
            <a class="nav-item nav-link" href="recherche.php">Recherche</a>
            <a class="nav-item nav-link" href="citation.php">Modification</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
<h1>La citation du jour</h1>
<hr>

<?php
include 'connexpdo.php';
$bdd = connexpdo('pgsql:dbname=citations;host=localhost;port=5432','postgres','passwordbdd');

$query = "SELECT COUNT(*) as nb FROM citation";
$result = $bdd->query($query);
$end = $result->fetch()['nb'];

echo '<p>'."Il y a ".'<strong>'.$end.'</strong>'." citations répertoriées".'</p>';

$rdm = random_int(1,$end);

echo '<p>'."Et voici l'une d'entre elles qui est générée aléatoirement :".'</p>';

$query =  "SELECT phrase,auteurid,siecleid FROM citation WHERE id=$rdm";
$result = $bdd->query($query);
$result = $result->fetch();

echo '<p class="font-weight-bold">'.$result['phrase'].'</p>';

$authorid = $result['auteurid'];
$siecleid = $result['siecleid'];

$query = "SELECT prenom,nom FROM auteur WHERE id=$authorid";
$result = $bdd->query($query);
$result = $result->fetch();

echo '<p>'.$result['prenom']." ".$result['nom'];

$query = "SELECT numero FROM siecle WHERE id=$siecleid";
$result = $bdd->query($query);
$result = $result->fetch();

echo " (".$result['numero']." ème siècle)".'</p>';

?>
</div>
</body>
</html>

