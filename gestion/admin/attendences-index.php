<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM da WHERE id = '$id'";
    $db->query($sql);
}
$c="employé";
$sql = "SELECT * FROM horaire ";
$res = $db->query($sql);
$pres = [];
while ($row = $res->fetch_object()) {
    $pres[] = $row;
}



?><?php
// Connexion à la base de données

// Requête pour récupérer les données de présence des employés
$query = "SELECT id_emp, SUM(entree_sortie = 2) AS nb_jours_presence FROM horaire GROUP BY id_emp";
$result = $db->query($query);


?>
<!-- HTML pour afficher la visualisation de présence -->


<div class="main">
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px">
        <a href="#"><strong><span class=""></span>Présences employés</strong></a>
        <hr>
    <div style="display:flex;align-items:center;margin:auto;">
        <?php require_once('presence_graphe_admin.php'); ?>
    </div>
        <!-- <div style="position: fixed; top: 0; left: 100;">
        <img src="presence_graphe_admin.php"  />
    </div> -->
    
    <!-- <div id="graphe-presence"> -->
    
        <!-- <img src="graphe_presence_survol.php"  />Ici sera affiché le graphe de présence -->
        
    <!-- </div> -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <th> No</th>
                <th>Nom de l"employé</th>
                <th>Arrivée</th>
                <th>Départ</th>
                <th>Date</th>
                <th>Statut</th>
    
    
            </thead>
            <tbody>
                <?php $i = 0;
                foreach ($pres as $attendence) : ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <?php $sql = "SELECT * FROM employe WHERE id ='$attendence->id_emp'";
                        $res = $db->query($sql);
                        $name = $res->fetch_object()->nom;
                        ?> <?php echo '<td class="employe" data-nom="' . $attendence->id_emp . '">' . $name . '</td>';?>
                        <td><?php echo $attendence->temps_entree ; ?></td>
                        <td><?php echo $attendence->temps_sortie ; ?></td>
                        <?php $date = new DateTime();
                        $d = $date->format($attendence->date);
                        ?>
                        <td><?php echo $d ?></td>
                        <?php if ($attendence->date) : ?>
                            <td><span class="badge badge-danger"><?php echo "présent" ?></span></td>
                        <?php else : ?>
                            <td><span class="badge badge-danger"><?php echo "Absent" ?></span></td>
                        <?php endif ?>
    
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
        
    
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            </br>
            <!--<a href="#"><strong><span class=""></span>Présences chef-chantier</strong></a>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <th> No</th>
                    <th>Nom de l"employé</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Statut</th>
        
        
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($pres as $attenden) : ?>
                        <tr>
                            <td><?php echo $i + 1 ?></td>
                            <?php $sql = "SELECT * FROM utilisateurs WHERE id = '$attenden->id_emp'";
        
                            $res = $db->query($sql);
                            $name = $res->fetch_object()->nom;
                            ?>
                            <?php echo '<td class="employe" data-nom="' . $name . '">' . $name . '</td>';?>
                            
                            <td><?php echo $attendence->temps_entree ; ?></td>
                            <td><?php echo $attendence->temps_sortie ; ?></td>
                            <?php $date = new DateTime();
                            $d = $date->format($attenden->date);
                            ?>
                            <td><?php echo $d ?></td>
                            <?php if ($attenden->date) : ?>
                                <td><span class="badge badge-danger"><?php echo "présent" ?></span></td>
                            <?php else : ?>
                                <td><span class="badge badge-danger"><?php echo "Absent" ?></span></td>
                            <?php endif ?>
        
                        </tr>
                    <?php $i++;
                    endforeach ?>
                </tbody>
            </table>-->
        </div>
    <br>
    </div>
</div>


<?php // require_once './footer.php'; ?>
<!-- JavaScript pour afficher le graphe de présence lorsqu'on survole un nom d'employé -->
<script>
// Récupérer tous les éléments de tableau avec la classe "employe"
var employes = document.getElementsByClassName("employe");

// Ajouter un événement de survol à chaque élément d'employé
for (var i = 0; i < employes.length; i++) {
    employes[i].addEventListener("click", function() {
        var nom = this.getAttribute("data-nom");
        var url = "graphe_presence_survol.php?id_emp=" + nom; // URL vers le script PHP qui génère le graphe de présence
        //window.open(url, "Graphe de présence de " + nom, "width=800,height=600"); // Ouvrir une nouvelle fenêtre avec le graphe de présence
    
        /*var url = "graphe_presence_survol.php?id_emp=" + nom; // URL vers le script PHP qui génère le graphe de présence
        var graphePresence = document.getElementById("graphe-presence");
        graphePresence.innerHTML = '<img   src="' + url + '" alt="Graphe de présence de ' + nom + '">';
    */});
}
</script>

    