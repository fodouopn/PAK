<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';
$ur=$_SESSION['id'];
/* Delete paper */

$c="employé";

$sql = "SELECT * FROM horaire where id_emp = $ur";
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


<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class=""></span>Présences employés</strong></a>
    <hr>

   

    <table class="table table-bordered">
        <thead>
            <th> No</th>
            <th>Nom </th>
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
                    ?>
 
 <?php echo '<td class="employe" data-nom="' . $attendence->id_emp . '">' . $name . '</td>';?>
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
 

<?php require_once './footer.php'; ?>
<!-- JavaScript pour afficher le graphe de présence lorsqu'on survole un nom d'employé -->


    