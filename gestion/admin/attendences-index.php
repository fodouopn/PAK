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



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class=""></span>Présences employé</strong></a>
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
            foreach ($pres as $attendence) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM employe WHERE id ='$attendence->id_emp'";
                    $res = $db->query($sql);
                    $name = $res->fetch_object()->nom;
                    ?>
 
                    <td><?php echo $name ?></td>
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
                    <td><?php echo $name ?></td>
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