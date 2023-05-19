<?php

session_start();
require_once './src/database.php';
if (isset($_POST['submit'])) {
    $error = '';
    if (strlen($_POST['mail']) < 1) {
        $error = 'entrer email';
    } else if (strlen($_POST['password']) < 1) {
        $error = ' entrer mot de passe';
    } else {
        $mail = $db->real_escape_string($_POST['mail']);
        $pass = $db->real_escape_string($_POST['password']);

        //$sql = "SELECT * from users where mail = '$mail'";
        //$res = $db->query($sql);
        if ($mail== $_POST['mail']) {
        $con="UPDATE `users` SET `password`='$pass' WHERE`mail`='$mail'";
                
                $re = $db->query($con);
               
        
            if ($re=== true) {
                
               

 echo '<script>alert("Mot de Passe changé avec succes")</script>';
echo "<script>window.location.href ='mdp.php'</script>";
            } else {
                
                echo '<script>alert("email invalide")</script>';
                
            }
        
    }
}
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">

    <title>Systeme de Management</title>
</head>

<body style=" background-image: linear-gradient(120deg, #f5d365, #fda085);">

    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-top: 30vh">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error) && strlen($error) > 1) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif ?>

                        <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']) ?>
                            </div>
                        <?php endif ?>

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">email</label>
                                <input type="text" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">nouveau mot de passe</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="row">

                                <div class="col col-xs-2">
                                    <button style="float:right" type="submit" name="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                            <div class="new">
                    <p><a href="index.php">connexion</a>  </p>
    
                    </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../resources/js/jquery-3.6.0.min.js"></script>
    <script src="./res/js/popper.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html