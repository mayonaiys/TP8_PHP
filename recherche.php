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
            <a class="nav-item nav-link" href="#">Recherche</a>
            <a class="nav-item nav-link" href="modification.php">Modification</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
<h1>Rechercher une citation</h1>
<hr>

<?php
include 'connexpdo.php';
$bdd = connexpdo('pgsql:dbname=citations;host=localhost;port=5432','postgres','passwordbdd');
?>

<form method="post" action="recherche.php">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Auteur</label>
        <select class="form-control" id="exampleFormControlSelect1" name="auteur">
            <?php
            $query = "SELECT nom FROM auteur";
            $result = $bdd->query($query);
            foreach ($result as $data){
                echo '<option>'.$data['nom'].'</option>';
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Siècle</label>
        <select class="form-control" id="exampleFormControlSelect1" name="siecle">
            <?php
            $query = "SELECT numero FROM siecle ";
            $result = $bdd->query($query);
            foreach ($result as $data){
                echo '<option>'.$data['numero'].'</option>';
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>
<br>
<?php
displayResult($bdd);
?>
</div>

</body>
</html>


<?php

function displayResult($bdd){
    if(isset($_POST['auteur']) && isset($_POST['siecle'])) {
        $auteur  = $_POST['auteur'];
        $siecle = $_POST['siecle'];
        echo '<table class="table">';
        echo '<thead>
                <tr>
                    <th scope="col">Citation</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Siècle</th>
                </tr>
            </thead>';
        $query = "SELECT id FROM siecle WHERE numero = $siecle";
        $result = $bdd->query($query);
        foreach ($result as $data){
            $siecleid = $data['id'];
        }
        $query = "SELECT id FROM auteur WHERE nom='$auteur'";
        $result = $bdd->query($query);
        foreach ($result as $data){
            $auteurid = $data['id'];
        }
        $query = "SELECT phrase FROM citation WHERE auteurid=$auteurid and siecleid=$siecleid";
        $result = $bdd->query($query);
        foreach($result as $data){
            echo '<tr>';
            echo '<td>'.$data['phrase'].'</td>';
            echo '<td>'.$auteur.'</td>';
            echo '<td>'.$siecle.'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
?>