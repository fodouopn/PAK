<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';


if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM assignation WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM assignation";
$res = $db->query($sql);
$as = [];
while ($row = $res->fetch_object()) {
    $as[] = $row;
}

//print_r($as);die;


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span>tache assignée</strong></a>
    <hr>
    <a href="./assign-project.php"><button class="btn btn-primary" type="button">Assigner une tache</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom du responsable</th>
            <th>Nom de la tache</th>
            <th>Poste</th>
            <th>Date</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($as as $project) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM employe WHERE id = '$project->id_emp'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                       $emp_name = $res->fetch_object()->nom;
                       
                       

                     ?>
                    <td><?php echo $emp_name ?></td>
                     <?php $sql = "SELECT * FROM tache WHERE id = '$project->id_tache'";
                     //echo $sql;die;
                     $res = $db->query($sql);
                     $no = $res->fetch_object()->nom_tache;
                      
                       
                     ?>
                    <td><?php echo $no ?></td>
                    <?php $sql = "SELECT * FROM tache WHERE id = '$project->id_tache'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                      
                       $proj = $res->fetch_object()->Details;

                     ?>

                    <td><?php echo $proj ?></td>
                    <td><?php echo $project->date ?></td>

                    <td>

                        <a href="./edit-department.php?edit=<?php echo $project->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $project->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>