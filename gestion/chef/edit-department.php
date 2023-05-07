<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

/*if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM assignation WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        echo "erreur";
        exit;
    } else {
        $department = $res->fetch_object();
    }
}*/


$sql = "SELECT * FROM employe";
$res = $db->query($sql);
$as = [];
while($row = $res->fetch_object()){
    $as[] = $row; 
}

$sql = "SELECT * FROM tache";
$res = $db->query($sql);
$ta = [];
while($row = $res->fetch_object()){
    $ta[] = $row; 
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
   

        $tache= $db->real_escape_string($_POST['tache']);
        $emp = $db->real_escape_string($_POST['emp']);
        $ia= $db->real_escape_string($_POST['id']);
        



        $sql = "UPDATE `assignation` 
        SET `id_tache`='$tache',`id_emp`='$emp' WHERE id = '$ia'";
            
        if ($db->query($sql) === true) {
           
            echo '<script>alert("Modification reussit")</script>';
            echo "<script>window.location.href ='assigned-project-index.php'</script>";
        } else {
            $error = "Failed to update department, Please check your details and try again";
        }
    }





?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
<a href="assigned-project-index.php"><span class=""></span> Retour</a>
    <a href="#"><strong><span class="fa fa-dashboard"></span> Modifier la tache</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_GET['edit'] ?>">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tache</label>
                            <select class="form-control" name="tache">
                                <option value="none">Sélectionner</option>
                                <?php foreach($ta as $d): ?>
                                <option value="<?php echo $d->id ?>"><?php echo $d->nom_tache ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">responsable</label>
                            <select class="form-control" name="emp">
                                <option value="none">Sélectionner</option>
                                <?php foreach($as as $da): ?>
                                <option value="<?php echo $da->id ?>"><?php echo $da->nom ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        
                       
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                            
                           </div>

 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>