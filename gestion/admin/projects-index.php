<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';



if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM tache WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM tache";
$res = $db->query($sql);
$tache = [];
while ($row = $res->fetch_object()) {
    $tache[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Tache</strong></a>
    <hr>
    <a href="./add-project.php"><button class="btn btn-primary" type="button">Ajouter une tache</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th> No</th>
            <th>nom de tache</th>
            <th>Details</th>
            <th>Date</th>
            <th>Option</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($tache as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->nom_tache ?></td>
                    <td><?php echo $p->Details ?></td>
                    <td><?php echo $p->date ?></td>

                    <td>

                        <a href="./edit-project.php?edit=<?php echo $p->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>