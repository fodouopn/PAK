<?php
// Connexion à la base de données
require_once './src/database.php';
// Requête pour récupérer les données de présence des employés
$query = "SELECT id_emp, SUM(entree_sortie = 2) AS nb_jours_presence FROM horaire GROUP BY id_emp";
$result = $mysqli->query($query);

// Générer le tableau HTML avec les noms des employés et leur nombre de jours de présence
echo '<table>';
while ($row = $result->fetch_assoc()) {
    $nom = $row['id_emp'];
    $nb_jours_presence = $row['nb_jours_presence'];
    echo '<tr>';
    echo '<td class="employe" data-nom="' . $nom . '">' . $nom . '</td>';
    echo '<td>' . $nb_jours_presence . '</td>';
    echo '</tr>';
}
echo '</table>';

// Fermer la connexion à la base de données

?>
<!-- HTML pour afficher la visualisation de présence -->
<div id="graphe-presence">
    <!-- Ici sera affiché le graphe de présence -->
</div>
<!-- JavaScript pour afficher le graphe de présence lorsqu'on survole un nom d'employé -->
<script>
// Récupérer tous les éléments de tableau avec la classe "employe"
var employes = document.getElementsByClassName("employe");

// Ajouter un événement de survol à chaque élément d'employé
for (var i = 0; i < employes.length; i++) {
    employes[i].addEventListener("click", function() {
        var nom = this.getAttribute("data-nom");
        var url = "graphe_presence_survol.php?id_emp=" + nom; // URL vers le script PHP qui génère le graphe de présence
        var graphePresence = document.getElementById("graphe-presence");
        graphePresence.innerHTML = '<img src="' + url + '" alt="Graphe de présence de ' + nom + '">';
    });
}
</script>