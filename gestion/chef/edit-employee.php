<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM employe WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./employee-index.php');
        exit;
    } else {
        $employee = $res->fetch_object();
    }
  
}
 


$sql = "SELECT * FROM employe";
$res = $db->query($sql);
$postes = [];
while($row = $res->fetch_object()){
    $postes[] = $row; 
}

if (isset($_POST['submit'])) {
    


        $id = $db->real_escape_string($_POST['id']);
        $nom = $db->real_escape_string($_POST['nom']);
        $prenom = $db->real_escape_string($_POST['prenom']);
        $numero = $db->real_escape_string($_POST['numero']);
        $email = $db->real_escape_string($_POST['email']);
        $poste = $db->real_escape_string($_POST['poste']);
        $sexe = $db->real_escape_string($_POST['sexe']);
        /*$do = $db->real_escape_string($_POST['dob']);
        $date = $db->real_escape_string($_POST['date']);
        $poste = $db->real_escape_string($_POST['poste']);
        $address = $db->real_escape_string($_POST['address']);
        $bpay = $db->real_escape_string($_POST['bpay']);*/
       

        if(!isset($_POST['poste'])){
            $sql1 =  "UPDATE `employe` 
            SET `poste`='$poste' where id = $id";
            $res = $db->query($sql1);
        }
        $sql =  "UPDATE `employe` 
        SET `nom`='$nom',`prenom`='$prenom',`numero`='$numero',
         sexe='$sexe' WHERE id = $id";
         
      //echo $sql;die;
      $res = $db->query($sql);
        if ($db->query($sql) === true) {
            $sql = "SELECT * FROM employe WHERE id = '$id'";
            $res = $db->query($sql);
            if ($res->num_rows < 1) {
                header('Location: ./employee-index.php');
                exit;
            } else {
                $employee = $res->fetch_object();
                //$msg= " Informations modifiées avec succes";
            }
            echo '<script>alert("Informations modifiées avec succes")</script>';
//echo "<script>window.location.href ='mdp.php'</script>";
            
        
        } else {
            $error = "Echec";
        }
    
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class=""> <a href="./employee-index.php">Retour /<strong></span></strong></a>
   <span class="fa fa-dashboard"> <a href=""><strong></span> Modifier un employé</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                  
                    
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <input type="hidden" name="id" value="<?php echo $employee->id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Nom</label>
                            <input type="text" name="nom" class="form-control" value="<?php echo $employee->nom ?>"  aria-describedby="emailHelp" placeholder="Entrer nom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">prenom</label>
                            <input type="textarea" name="prenom"  value="<?php echo $employee->prenom ?>" class="form-control" id="exampleInputPassword1" placeholder="entrer prenom">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Numero</label>
                            <input type="textarea" name="numero" value="<?php echo $employee->numero ?>"  class="form-control" id="exampleInputPassword1" placeholder="entrer numero">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="textarea" name="email" class="form-control" value="<?php echo $employee->mail ?>" id="exampleInputPassword1" placeholder="enter email">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Genre</label>
                           <select class="form-control" name="sexe">
                                <option value="none">Sélectionner</option>
                                <option value="Homme">Homme</option>
                                 <option value="femme">Femme</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Date</label>
                            <input type="text" name="date" value="<?php echo $employee->date ?>"  class="form-control" id="exampleInputPassword1" placeholder="enter date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Poste</label>
                            <select class="form-control" name="poste">
                                <option value="none">Sélectionner</option>
                                <?php foreach($postes as $d): ?>
                                <option value="<?php echo $d->id ?>"><?php echo $d->poste ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        
                          
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit"  class="btn btn-primary">Envoyer</button>
                            
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>