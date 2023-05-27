<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


/*$sql = "SELECT * FROM department";
$res = $db->query($sql);
$departments = [];
while($row = $res->fetch_object()){
    $departments[] = $row; 
}*/

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['nom_tache']) < 1) {
        $error = "enrter le nom de la tache";
    } else if (strlen($_POST['detail']) < 1) {

        $error = " entrer  le detail";
    }else {

        $tache = $db->real_escape_string($_POST['nom_tache']);
        $detail = $db->real_escape_string($_POST['detail']);
        $datd = $db->real_escape_string($_POST['date_d']);
        $datf = $db->real_escape_string($_POST['date_f']);
        
        $sql = "INSERT INTO tache
                (nom_tache, Details,date_d,date_f)
                values ('$tache','$detail','$datd','$datf')";
                //echo $sql;die;
        if ($db->query($sql) === true) {
            $msg = "Tache ajouté avec succès";
            echo '<script>alert("Tache ajoutée avec succès")</script>';
echo "<script>window.location.href ='add-project.php'</script>";
        }
    }
}



?>

   <span class=""> <a href="./projects-index.php">Retour/</span> </a>
   <span class=""> <a href=""><strong></span> Ajouter une nouvelle tache</strong></a>
    <hr>


    <div class="main">
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Nom tache</label>
                            <input type="text" name="nom_tache" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le nom de la tache">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Détail</label>
                            <input type="text" name="detail" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le detail">
                        
                           
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Date de début</label>
                            <input type="date" name="date_d" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer la date de début">
                        
                           
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Date de fin</label>
                            <input type="date" name="date_f" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer la date de fin">
                        
                           
                        </div>  
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                            
                        </div>


                    </form>
               
        </div>
</br></br>
    </div>
</div>

<?php require_once './footer.php'; ?>