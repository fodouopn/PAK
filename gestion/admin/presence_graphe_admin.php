<?php
if ($_SESSION['poste'] != 'admin'  ) {
    header('Location:./dashboard.php');
    exit;
}

// Inclusion de la bibliothèque JPGraph
require_once  '../jpgraph/src/jpgraph.php';
require_once '../jpgraph/src/jpgraph_bar.php';

// Connexion à la base de données
require_once './src/database.php';
// Vérification de la connexion
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Récupération des données de la table presence
$sql = "SELECT id_emp, SUM(CASE WHEN entree_sortie = 2 THEN 1 ELSE 0 END) AS nb_jours_presence FROM horaire GROUP BY id_emp";
$result = $db->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $o=$row["id_emp"];
    $sql1 = "SELECT nom FROM employe Where $o = id ";
$result1 = $db->query($sql1);
$row1 = $result1->fetch_assoc();
$row["id_emp"] = $row1["nom"];
    $data[$row["id_emp"]] = $row["nb_jours_presence"];
}
// Fermeture de la connexion à la base de données

// Création du graphique

$graph = new Graph(1000, 200);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(80,30,50,70);

// Ajout des données au graphique
$datax = array_keys($data);
$datay = array_values($data);
$barplot = new BarPlot($datay);
$barplot->value->Show();
$graph->Add($barplot);

// Personnalisation des axes et des titres
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
$graph->xaxis->SetLabelAngle(90);
$graph->yaxis->title->Set("Nombre de jours de présence");
$graph->xaxis->title->Set("employés");
$graph->title->Set("Présence des employés");

// Affichage du graphique
$datetime_to_string = time();

$graph_name = "res/img/" . $_SESSION['id'] . "_" . $datetime_to_string . ".png";

$graph->Stroke($graph_name);
echo "<img src='" . $graph_name . "' />";

?>