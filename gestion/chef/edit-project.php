<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

$sql = "SELECT * FROM tache";
$res = $db->query($sql);
$Detailss = [];
while($row = $res->fetch_object()){
    $Detailss[] = $row; 
}

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM tache WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./projects-index.php');
        exit;
    } else {
        $project = $res->fetch_object();

    }
}




if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    
        
        $id = $db->real_escape_string($_POST['id']);
        $nom_tache = $db->real_escape_string($_POST['nom']);
        $Details = $db->real_escape_string($_POST['detail']);



        $sql = "UPDATE tache
            SET nom_tache = '$nom_tache', Details = '$Details' WHERE id = '$id'";
        if ($db->query($sql) === true) {
            echo '<script>alert("Tache modifiée avec succes")</script>';
            echo "<script>window.location.href ='projects-index.php'</script>";
        } else {
            $error = "Echec , vérifier vos informations";
        }
    }





?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
<a href="projects-index.php"><span class=""></span> Retour </a>
    <a href="edit-project.php"><strong><span class="fa fa-dashboard"></span>/ Modifier la tache</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error) && strlen($error) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($msg) && strlen($msg) > 1) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']) ?>
                        </div>
                    <?php endif ?>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Nom de la tache</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $project->nom_tache ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Détail</label>
                            <input type="text" name="detail" class="form-control" value="<?php echo $project->Details ?>" aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        
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