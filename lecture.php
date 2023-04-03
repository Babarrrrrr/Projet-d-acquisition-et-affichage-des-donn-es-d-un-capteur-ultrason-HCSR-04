<?php
require_once 'connexion.php'; // On inclut la connexion à la base de données
//actualisation de la page toutes les 2 secondes
header("refresh: 2"); 

//ouverture du ficher en mode lecture
$fichier = __DIR__ . DIRECTORY_SEPARATOR . 'ultrason.txt';
$ressource = fopen($fichier,'r');

if (!$ressource) {
    echo "Impossible d'ouvrir le fichier ultrason.txt";
}
//on stocke la taille du texte dans une variable
$tailleTexte = strlen(file_get_contents('ultrason.txt'));
echo $tailleTexte;
echo '\n';
// on place le curseur sur la dernière data du .txt
echo fseek($ressource,$tailleTexte-6);
echo '\n';
//fonction permettant de connaître la position du curseur
echo ftell($ressource);
echo '\n';
//lecture des 3 premiers caractères
$data = fread($ressource, 3);
echo $data;
$donnees = $bdd->prepare("INSERT INTO DS18B20 (donnees) VALUES ('$data')");
$donnees->execute();
/*    $stmt = $con->prepare("INSERT INTO DS18B20 (donnees) VALUES (?)");
    $stmt->bind_param("sss", $type , $name, $description);
    $stmt->execute(); */

    ?>
