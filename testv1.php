<?php

require_once 'connexion.php';

$req = $bdd->prepare('SELECT donnees FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10');
$req->execute();
$data = $req->fetchAll();
foreach($data as $point) {
    $datay1 = array($point['donnees']);
    //echo $messages['X'] . ": " . $messages['Y'] . "<br>";
}
$i;
for($i=0; $i < sizeof($datay1);$i++){
    echo $datay1[$i];
}
var_dump($data);
var_dump($datay1);
for($i=0; $i < sizeof($data);$i++){
    echo $data['donnees'];
}
