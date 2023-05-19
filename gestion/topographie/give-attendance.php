<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


$id = $_SESSION['id'];
if (isset($_POST['submit'])) {
    $error = '';
    $m = 'employé';
   

       

        $sql = "INSERT INTO presence
                (id_emp,statut)
                values ('$id','$m')";

        if ($db->query($sql) === true) {
            //$msg = "Enregistrement reussi";
            echo '<script>alert("Enregistrement reussi")</script>';
echo "<script>window.location.href ='attendance.php'</script>";
        } else {
            $error = "Echec d'enregistrement, veuillez recommencer";
        }
    
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <span class="fa fa-dashboard"> <a href="./attendance.php">Retour/</span> </a>
    <span class="fa fa-dashboard"> <a href=""><strong></span> s'enregistrer</strong></a>
    
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                   
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <!--<div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">periode</label>
                            <input type="time" name="in-time" class="form-control" value="" aria-describedby="emailHelp">
                        </div>-->
                        <!--<div class="form-group">
                            <label for="exampleInputPassword1">Paper name</label>
                            <input type="textarea" name="paper-name" value="" class="form-control"
                                id="exampleInputPassword1" placeholder="enter paper name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Year</label>
                            <input type="textarea" name="year" value="" class="form-control" id="exampleInputPassword1"
                                placeholder="enter year">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Degree</label>
                            <input type="textarea" name="degree" value="" class="form-control"
                                id="exampleInputPassword1" placeholder="enter degree">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Scanned paper</label>
                            <input type="file" name="image-file" value="" class="form-control"
                                id="exampleInputPassword1">
                        </div>-->
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">S'enregistrer</button>
                            <a href="attendance.php"><button type="button" class="btn btn-primary">Annuler</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>