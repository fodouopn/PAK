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
   

        $nom = $db->real_escape_string($_POST['nom']);
        $model = $db->real_escape_string($_POST['model']);
        $etat = $db->real_escape_string($_POST['etat']);
        $com = $db->real_escape_string($_POST['com']);
        $sql = "INSERT INTO `engins`( `nom`, `model`, `etat`, `commentaire`) 
        VALUES ('$nom','$model','$etat','$com')";
                //echo $sql;die;
        if ($db->query($sql) === true) {
            $msg = "Tache ajouté avec succès";
            echo '<script>alert("Tache ajouté avec succès")</script>';
echo "<script>window.location.href ='ajout.php'</script>";
        }
    }




?>


   <span class=""> <a href="./engins.php">Retour/</span> </a>
   <span class=""> <a href=""><strong></span> Ajouter une nouvelle tache</strong></a>
    <hr>


</div>
<div class="main">
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
                    

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Nom du matériel</label>
                            <input type="text" name="nom" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le nom du matériel">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Model</label>
                            <input type="text" name="model" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le model">
                        </div>   
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Etat</label>
                            <input type="text" name="etat" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer l'etat'">
                        </div>  
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">commentaire</label>
                            <input type="text" name="com" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le detail">
                        
                           
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