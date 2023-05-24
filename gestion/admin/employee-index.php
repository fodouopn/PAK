<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    var_dump($_GET['delete']);
    // $sql = "DELETE FROM employe WHERE id = '$id'";
    $sql = "UPDATE employe SET deleted_yn = true WHERE id = '$id'";
    $db->query($sql);
}

if (isset($_GET['delete1'])) {
    $id = $db->real_escape_string($_GET['delete1']);
    // $sql = "DELETE FROM utilisateurs WHERE id = '$id'and choix != 'sadmin' ";
    $sql = "UPDATE utilisateurs SET deleted_yn = true WHERE id = '$id'and choix != 'sadmin' ";
    $db->query($sql);
}

$sql = "SELECT * FROM employe WHERE deleted_yn = false";
$res = $db->query($sql);
$employees = [];
while ($row = $res->fetch_object()) {
    $employees[] = $row;
}

$sql = "SELECT * FROM utilisateurs where poste != 'admin' AND deleted_yn = false";
$res = $db->query($sql);
$employe = [];
while ($row = $res->fetch_object()) {
    $employe[] = $row;
}







?>



<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

    <a href="#"><strong><span class=""></span> Employés</strong></a>
    <hr>
    <a href="add-employee.php"><button class="btn btn-primary" type="button">Ajouter un Employé</button></a>
    <br>
    <br>

   
    
    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom</th>
            <th>prénom</th>
            <th>numero</th>
            <th>Email</th>
            <th>Sexe</th>
            <th>Poste</th>
            <th>Date</th>

            <th>Option</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($employees as $e) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $e->nom?></td>
                    <td><?php echo $e->prenom ?></td>
                    <td><?php echo $e->numero?></td>
                    <td><?php echo $e->mail ?></td>
                     <td><?php echo $e->sexe?></td>
                      <td><?php echo $e->poste?></td>
                    <td><?php echo $e->date ?></td>

                    <td>

                        <a href="edit-employee.php?edit=<?php echo $e->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $e->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>

    <br>

    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class=""> <strong> Liste responsable</span> </strong>
    <hr>


</div>
    <br>
   
    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom</th>
            <th>prénom</th>
            <th>numero</th>
            <th>Email</th>
            <th>Sexe</th>
            <th>Poste</th>
            <th>Date</th>

            <th>Option</th>
        </thead>
        <tbody>
            <?php //$i = 0;
            foreach ($employe as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->nom?></td>
                    <td><?php echo $p->prenom ?></td>
                    <td><?php echo $p->numero?></td>
                    <td><?php echo $p->mail ?></td>
                     <td><?php echo $p->sexe?></td>
                      <td><?php echo $p->poste?></td>
                    <td><?php echo $p->date ?></td>

                    <td>

                        <a href="employee-chef.php?edit=<?php echo $p->id ?>" class="btn btn-info">Modifier</a>
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete1=<?php echo $e->id ?>" class="btn btn-danger">Supprimer</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>
 
<?php require_once './footer.php'; ?>