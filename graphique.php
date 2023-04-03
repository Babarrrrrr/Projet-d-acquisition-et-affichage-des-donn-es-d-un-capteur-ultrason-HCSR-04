<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph-4.4.1/src/jpgraph.php');
require_once ('jpgraph-4.4.1/src/jpgraph_line.php');
require_once ('jpgraph-4.4.1/src/jpgraph_plotmark.inc.php');
require_once ('jpgraph-4.4.1/src/jpgraph_plotline.php');
require_once 'connexion.php';

//ouverture du ficher en mode lecture
/*$fichier = __DIR__ . DIRECTORY_SEPARATOR . 'ultrason.txt';
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
$donnees = $bdd->prepare("INSERT INTO DS18B20 VALUES ('$data')");
$donnees->execute();*/

/*$req = $bdd->prepare('SELECT * FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10');
$req->execute();
$data = $req->fetchAll();
foreach($data as $point) {
    $datay1 = array($point['donnees']);
    //echo $messages['X'] . ": " . $messages['Y'] . "<br>";
}
*/

// Requête pour obtenir les 10 dernières valeurs du champ "donnees"
$query = "SELECT donnees FROM ds18b20 ORDER BY id_donnees DESC LIMIT 10";
$result = $bdd->query($query);

// Récupération des données dans un tableau
$data = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row["donnees"];
}

// Fermeture de la connexion à la base de données
$pdo = null;

// Paramètres du graphique
$width = 600;
$height = 600;
$title = "Graphique de courbe des 10 dernières valeurs de la table HCSR-04";
$x_axis_label = "Valeurs";
$y_axis_label = "Distance";

// Création du graphique
$graph = new Graph($width, $height);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->title->Set($title);
$graph->xaxis->title->Set($x_axis_label);
$graph->yaxis->title->Set($y_axis_label);

// Création de la courbe
$lineplot = new LinePlot($data);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

// Ajout de la courbe au graphique
$graph->Add($lineplot);

// Ajout de marqueurs pour chaque point de données
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetFillColor("blue");
$lineplot->mark->SetColor("blue");
$lineplot->mark->SetSize(5);

/* Ajout des valeurs exactes au-dessus de chaque point de données
$count = count($lineplot->coords);
for ($i = 0; $i < $count; ++$i) {
    $text = new Text($lineplot->coords[$i][0], $lineplot->coords[$i][1], $data[$i]);
    $text->SetFont(FF_ARIAL, FS_NORMAL, 12);
    $text->SetAlign('center', 'top');
    $graph->AddText($text);
}*/

// Génération de l'image en base64
/*ob_start();
$graph->Stroke(_IMG_HANDLER);
$image_data = ob_get_clean();
$image_base64 = base64_encode($image_data);

// Affichage de l'image
echo '<img src="data:image/png;base64,' . $image_base64 . '" alt="Graphique des 10 dernières valeurs de la table ds18b20">';
*/
// Affichage du graphique
$graph->Stroke();


/*
// Setup the graph
$graph = new Graph(500,350);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Filled Y-grid');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,63);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('A','B','C','D','E','F','G','H','I','J'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($data);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Courbe 1');

$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();

*/
?>