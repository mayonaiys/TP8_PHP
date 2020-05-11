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
                    <a class="nav-item nav-link" href="citation.php">Informations</a>
                    <a class="nav-item nav-link" href="recherche.php">Recherche</a>
                    <a class="nav-item nav-link" href="#">Modification</a>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <h1>Ajout</h1>
            <form method="post" action="modification.php">
                <div class="form-group">
                    <label for="addid">ID  de l'auteur</label>
                    <input type="text" class="form-control" placeholder="Entrez l'id  de l'auteur" name="auteurid">
                </div>
                <div class="form-group">
                    <label for="addauteur">Nom de l'auteur</label>
                    <input type="text" class="form-control" placeholder="Entrez l'id  de l'auteur" name="nom">
                </div>
                <div class="form-group">
                    <label for="exampleInputtext1">Prénom de l'auteur</label>
                    <input type="text" class="form-control" placeholder="Entrez le prénom de l'auteur" name="prenom">
                </div>
                <div class="form-group">
                    <label for="exampleInputtext1">ID du siècle</label>
                    <input type="text" class="form-control" placeholder="Entrez l'id du siècle" name="siecleid">
                </div>
                <div class="form-group">
                    <label for="exampleInputtext1">Siècle</label>
                    <input type="text" class="form-control" placeholder="Entrez le siècle" name="numero">
                </div>
                <div class="form-group">
                    <label for="exampleInputtext1">Citation</label>
                    <input type="text" class="form-control" placeholder="Entrez la ciation" name="phrase">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </body>
</html>

<?php
    include 'connexpdo.php';
    $bdd = connexpdo('pgsql:dbname=citations;host=localhost;port=5432','postgres','passwordbdd');
    function add($bdd){
        if(isset($_POST['auteurid']) && isset($_POST['nom']) && isset($_POST['prenom'])){
            echo "test";
            $addAuthor = $bdd->prepare('INSERT INTO auteur(id,nom,prenom) VALUES(:id, :nom, :prenom)');
            $addAuthor = $bdd->execute(array(
               'id'=>$_POST['auteurid'],
               'nom'=>$_POST['nom'],
               'prenom'=>$_POST['prenom']
            ));
        }
    }
    add($bdd);

?>
