<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';



if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM engins WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM engins";
$res = $db->query($sql);
$tache = [];
while ($row = $res->fetch_object()) {
    $tache[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class=""></span> Matériels</strong></a>
    <hr>
    <a href="./ajout.php"><button class="btn btn-primary" type="button">Ajouter un materiel</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom</th>
            <th>model</th>
            <th>Etat</th>
            <th>Commentaire</th>
            <th>Date d'ajout</th>
            
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($tache as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->nom ?></td>
                    <td><?php echo $p->model ?></td>
                    <td><?php echo $p->etat ?></td>
                    <td><?php echo $p->commentaire ?></td>
                    <td><?php echo $p->date ?></td>

                    <!--<td>

                        <a href="./modification.php?edit=<?php echo $p->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>-->
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>