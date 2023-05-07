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
$sql = "SELECT * FROM tache";
$res = $db->query($sql);
$tache = [];
while ($row = $res->fetch_object()) {
    $tache[] = $row;
}

?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class=""></span>Tache</strong></a>
    <hr>
    <!--  <a href="./assign-project.php"><button class="btn btn-primary" type="button">Assigner une tache</button></a>
    --> <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th> No</th>
            <th>nom de tache</th>
            <th>Details</th>
            <th>Date de début </th>
            <th>Date de fin</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($tache as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->nom_tache ?></td>
                    <td><?php echo $p->Details ?></td>
                    <td><?php echo $p->date_d ?></td>
                    <td><?php echo $p->date_f ?></td>

                   <!--  <td>

                        <a href="./edit-project.php?edit=<?php // echo $p->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php //echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Supprimer</a>


                    </td> -->
                </tr>
            <?php $i++; endforeach ?>
        </tbody>


        
   
    </table>


   


</div>
</br>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
</br>
</br>
<a href="#"><strong><span class=""></span>Assignation de tache</strong></a>
    <hr>
    
    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom du responsable</th>
            <th>Nom de la tache</th>
            <th>Date de début</th>
            <th>Date de fin </th>

            <th>Statut</th>
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
                       $proj_name = $res->fetch_object()->nom_tache;
                       
                     ?>
                    <td><?php echo $proj_name ?></td>
                    <?php $sql = "SELECT * FROM tache WHERE id = '$project->id_tache'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                      
                       $proj = $res->fetch_object()->date_d;

                     ?>

                    <td><?php echo $proj ?></td>
                    <?php $sql = "SELECT * FROM tache WHERE id = '$project->id_tache'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                      
                       $p_f = $res->fetch_object()->date_f;

                     ?>
                    <td><?php echo $p_f?></td>
                    <?php $sql = "SELECT * FROM tache WHERE id = '$project->id_tache'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                      
                       $p_f = $res->fetch_object()->statut;
                      

                     ?>
                    <td><?php
                    if ($p_f==1) {
                        echo "Tache terminée";

                    }else{
                        echo "Tache en cours";
                    }
                    ?></td>

                  <!--  <td>

                        <a href="./edit-department.php?edit=<?php //echo $project->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php //echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $project->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>--> 
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>