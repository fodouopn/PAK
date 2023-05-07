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
$sql = "SELECT * FROM presence ";
$res = $db->query($sql);
$pres = [];
while ($row = $res->fetch_object()) {
    $pres[] = $row;
}
$ui=$_SESSION['id'] ;

$sql1 = "SELECT * FROM presence where id_emp = '$ui'";
$res = $db->query($sql1);
$pre = [];
while ($row = $res->fetch_object()) {
    $pre[] = $row;
}

?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span>Présences</strong></a>
    
    <hr>
    <a href="./presence.php" class="btn btn-primary">s'enregistrer</a>
    <br>
    <br>
    <table class="table table-bordered">
        <thead>
            <th> No</th>
            <th>Nom de l"employé</th>
            <th>Date</th>
            <th>Statut</th>


        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($pres as $attendence) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM employe WHERE id = '$attendence->id_emp' ";

                    $res = $db->query($sql);
                    $name = $res->fetch_object()->nom;
                    ?>
                    <td><?php echo $name ?></td>
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

    <table class="table table-bordered">
        <thead>
            <th> No</th>
            <th>Nom de l"employé</th>
            <th>Date</th>
            <th>Statut</th>


        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($pre as $attenden) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM utilisateurs WHERE id = '$attenden->id_emp'";

                    $res = $db->query($sql);
                    $name = $res->fetch_object()->nom;
                    ?>
                    <td><?php echo $name ?></td>
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
    </table>
</div>

<?php require_once './footer.php'; ?>