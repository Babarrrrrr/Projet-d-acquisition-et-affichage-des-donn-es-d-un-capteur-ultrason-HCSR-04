<?php
header("refresh: 1"); 
 /*
require_once 'connexion.php';

header("refresh: 2"); 

//ouverture du ficher en mode lecture
$fichier = __DIR__ . DIRECTORY_SEPARATOR . 'ultrason.txt';
$ressource = fopen($fichier,'r');

if (!$ressource) {
    echo "Impossible d'ouvrir le fichier ultrason.txt";
}
//on stocke la taille du texte dans une variable
$tailleTexte = strlen(file_get_contents('ultrason.txt'));
// on place le curseur sur la dernière data du .txt
fseek($ressource,$tailleTexte-6);
//lecture des 3 premiers caractères
$data = fread($ressource, 3);
//echo "$data \n";
$donnees = $bdd->prepare("INSERT INTO ds18b20 (donnees) VALUES ('$data')");
$donnees->execute();

$req = $bdd->prepare('SELECT * FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10');
    $req->execute();
    //$data = $req->fetch();
    $data = $req->fetchAll();
    foreach($data as $point) {
        echo $point['donnees'] ."<br>";
    } */
?> 

<!doctype html>
<html lang="fr">
  <head>

    <!--ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!--<script>
		$(document).ready(function() {
			setInterval(function() {
				$('#graph-container').load('graphique.php');
			}, 2000);
		});
	</script>-->

<script>
      function updateGraphs() {
        $.ajax({
          url: 'graphique.php',
          type: 'GET',
          success: function(data) {
            $('#graph-container').html(data);
          }
        });
      }

      setInterval(updateGraphs, 2000); // rafraîchit le contenu toutes les 2 secondes
      </script>

    <title>Graphique des données capteur ultrason HC-SR04</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
        <div class="container">
            <div class="col-md-12">

                <div class="text-center">
                        <h1 class="p-5">Graphique des données capteur ultrason HC-SR04</h1>
                        <hr />
        
        <?php
               require_once 'connexion.php';

               //ouverture du ficher en mode lecture
$fichier = __DIR__ . DIRECTORY_SEPARATOR . 'ultrason.txt';
$ressource = fopen($fichier,'r');

if (!$ressource) {
    echo "Impossible d'ouvrir le fichier ultrason.txt";
}
//on stocke la taille du texte dans une variable
$tailleTexte = strlen(file_get_contents('ultrason.txt'));
// on place le curseur sur la dernière data du .txt
echo fseek($ressource,$tailleTexte-6);
//lecture des 3 premiers caractères
$data = fread($ressource, 3);
$donnees = $bdd->prepare("INSERT INTO DS18B20 (donnees) VALUES ('$data')");
$donnees->execute();


                // on affiche les 10 dernières données
                $req = $bdd->prepare('SELECT donnees FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10');
                $req->execute();
                $data = $req->fetchAll();
                foreach($data as $point) {
                    echo $point['donnees'] ."<br>";
                } 
            ?>



            <div id="graph-container"><img src="graphique.php"></div>
            <img src="graphiqueBaton.php">

  </body>
</html>