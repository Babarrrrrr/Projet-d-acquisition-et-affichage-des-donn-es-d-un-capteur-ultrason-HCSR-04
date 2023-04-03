<?php
require_once ('jpgraph-4.4.1/src/jpgraph.php');
require_once ('jpgraph-4.4.1/src/jpgraph_line.php');
require_once ('jpgraph-4.4.1/src/jpgraph_plotmark.inc.php');
require_once ('jpgraph-4.4.1/src/jpgraph_plotline.php');
require_once ('jpgraph-4.4.1/src/jpgraph_bar.php');
require_once 'connexion.php';


// Requête pour obtenir les 10 dernières valeurs du champ "donnees"
$query = "SELECT donnees FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10";
$result = $bdd->query($query);

// Récupération des données dans un tableau
$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row["donnees"];
}

// Paramètres du graphique
$width = 600;
$height = 400;
$title = "Graphique en bâtons des 10 dernières valeurs de la table HCSR-04";
$x_axis_label = "Valeurs";
$y_axis_label = "Distance";

// Création du graphique
$graph = new Graph($width, $height);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->title->Set($title);
$graph->xaxis->title->Set($x_axis_label);
$graph->yaxis->title->Set($y_axis_label);

// Création des barres
$barplot = new BarPlot($data);
$barplot->SetFillColor("blue");

// Ajout des barres au graphique
$graph->Add($barplot);

/* Ajout des valeurs exactes au-dessus de chaque barre
$count = count($barplot->coords);
for ($i = 0; $i < $count; ++$i) {
    $text = new Text($barplot->coords[$i][0], $barplot->coords[$i][1], $data[$i]);
    $text->SetFont(FF_ARIAL, FS_NORMAL, 12);
    $text->SetAlign('center', 'bottom');
    $graph->AddText($text);
} */

// Affichage du graphique
$graph->Stroke();
?>
