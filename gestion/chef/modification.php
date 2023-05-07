<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';



if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM engins WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./engins.php');
        exit;
    } else {
        $project = $res->fetch_object();

    }
}

$sql = "SELECT * FROM engins";
$res = $db->query($sql);
$models = [];
while($row = $res->fetch_object()){
    $models[] = $row; 
}


if (isset($_POST['submit'])) {
    
    
        
        $id = $db->real_escape_string($_POST['id']);
        $nom = $db->real_escape_string($_POST['nom']);
        $model = $db->real_escape_string($_POST['model']);
        $etat= $db->real_escape_string($_POST['etat']);
        $com = $db->real_escape_string($_POST['com']);



        $sql = "UPDATE `engins`
        SET `nom`='$nom',`model`='$model',`etat`='$etat',`commentaire`='$com ' WHERE id = '$id'";
                $res = $db->query($sql);
                
                if ($db->query($sql) === true) {
                    $sql = "SELECT * FROM engins WHERE id = '$id'";
                    $res = $db->query($sql);
                    if ($res->num_rows < 1) {
                        header('Location: ./engins.php');
                        exit;
                    } else {
                        $project = $res->fetch_object();
                        //$msg= " Informations modifiées avec succes";
                    }
                    echo '<script>alert("Tache modifiée avec succes")</script>';
                    //echo "<script>window.location.href ='modification.php'</script>";
            
        } else {
            $error = "Echec , vérifier vos informations";
        }
    }





?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
<a href="engins.php"><span class=""></span> Retour/ </a>
    <a href=""><strong><span class="fa fa-dashboard"></span> Modifier les informations</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
               
                   

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <input type="hidden" name="id" value="<?php echo $project->id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Nom </label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $project->nom ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Model</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $project->model ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Etat</label>
                            <input type="text" name="etat" class="form-control" value="<?php echo $project->etat ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Commentaire</label>
                            <input type="text" name="com" class="form-control" value="<?php echo $project->commentaire ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        
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