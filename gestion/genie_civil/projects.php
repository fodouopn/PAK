<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';


if (isset($_GET['update'])) {
    $id = $db->real_escape_string($_GET['update']);
    
    $sql = "UPDATE tache SET statut = '1' WHERE id = '$id'";
      if ($db->query($sql) === true) {
            $msg = "statut Mise a jour";
        } else {
            $error = "Echec, svp verifier vos détails et réessayer";
        }
}

$emp_id  = $_SESSION['id'];
$sql = "SELECT * FROM assignation WHERE id_emp = '$emp_id'";
//echo $sql;die;
$res = $db->query($sql);
$assigned_projects = [];
while ($row = $res->fetch_object()) {
    $assigned_projects[] = $row;
}

$newProj = [];
foreach( $assigned_projects as $p) {
    
  $sql = "SELECT * FROM tache WHERE id = '$p->id_tache'" ;
  
  $res = $db->query($sql);
  while($row= $res->fetch_object()){
     $newProj[] = $row; 
  }
  //print_r($newProj);die;
  //$newProj['name'] = $res->fetch_object()->project_name;
  
}

//print_r($newProj['name']);die;
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Taches assignées</strong></a>
    <hr>
    
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>No</th>
            <th>Nom de la tache</th>
            <th>Statut</th>

            <th>Action</th>
        </thead>
        <tbody>
          <?php $i=0; foreach($newProj as $e): ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $e->nom_tache ?></td>
                  
                    <td> 

<?php
          
    $status = $e->statut == 0 ? 'En cours' : 'Finis';
    $status_label = $e->statut == 0 ? 'success' : 'danger'; ?>
<span class="btn btn-<?php echo $status_label?> text-uppercase"> <?php echo $status ?></span>
</td>
                     
                    <td>
                         <a onclick='return confirm("etes vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?update=<?php echo $e->id; ?>" class="btn btn-primary"> <i class="fas fa-check-double"></i>Mettre a jour le statut</a>
                    </td>

                     
                       


                    </td>
                </tr>
           <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>