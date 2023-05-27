<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['poste'] != 'ingenieur des travaux' ) {
    header('Location:./dashboard.php');
    exit;
}

/*$sql = "SELECT * FROM Poste";
$res = $db->query($sql);
$Postes = [];
while($row = $res->fetch_object()){
    $Postes[] = $row; 
}*/

if (isset($_POST['submit'])) {
    
   

        $nom = $db->real_escape_string($_POST['nom']);
        $prenom = $db->real_escape_string($_POST['prenom']);
        $sexe = $db->real_escape_string($_POST['sexe']);
        $email = $db->real_escape_string($_POST['email']);
        $phone = $db->real_escape_string($_POST['phone']);
        /*$gender = $db->real_escape_string($_POST['gender']);
        $dob = $db->real_escape_string($_POST['dob']);*/
        $pass = $db->real_escape_string($_POST['pass']);
        $poste = $db->real_escape_string($_POST['poste']);
        /*$address = $db->real_escape_string($_POST['address']);
        $bpay = $db->real_escape_string($_POST['bpay']);*/


        $sql = "INSERT INTO `employe`( `nom`, `prenom`, `mail`, `pass`, `numero`, `sexe`, `poste`) 
        VALUES ('$nom'
        ,'$prenom','$email','$pass','$phone ','$sexe','$poste')";
       //echo $sql;die;
        if ($db->query($sql) === true) {
            echo '<script>alert("Employé ajouté avec succes")</script>';
            //$msg = "Employee added successfully";
        } else {
            $error = "Failed to add employee, Please check your details and try again";
        }
    
}



?>

<div class="main">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <span class=""> <a href="employee-index.php">Retour /</span></a>
       <span class="fa fa-dashboard"> <a href=""><strong>Ajouter un employé</span> </strong></a>
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
                                <label for="exampleInputEmail1" style="color:black">Nom</label>
                                <input type="text" name="nom" class="form-control"  aria-describedby="emailHelp" placeholder="Entrer le nom">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Prenom</label>
                                <input type="textarea" name="prenom"  class="form-control" id="exampleInputPassword1" placeholder="entrer le prenom">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="textarea" name="email" class="form-control" id="exampleInputPassword1" placeholder="entrer l'email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Numero</label>
                                <input type="text" name="phone"  class="form-control" id="exampleInputPassword1" placeholder="entrer le numero">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="color:black">sexe</label>
                               <select class="form-control" name="sexe">
                                    <option value="none">SELECT</option>
                                    <option value="Homme">Homme</option>
                                     <option value="Femme">Femme</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" name="pass"  class="form-control" id="exampleInputPassword1" placeholder="entrer le mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Poste</label>
                                <input type="text" name="poste"  class="form-control" id="exampleInputPassword1" placeholder="entrer le poste">
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

</div>


<?php require_once './footer.php'; ?>