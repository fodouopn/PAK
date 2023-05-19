<?php

session_start();
require_once './src/database.php';
if (isset($_POST['submit'])) {
    $error = '';
    if (strlen($_POST['email']) < 1) {
        $error = 'entrer votre email';   
    } else if (strlen($_POST['password']) < 1) {
        $error = ' entrer votre mot de passe';
    } else {
        $email = $db->real_escape_string($_POST['email']);
        $password = $db->real_escape_string($_POST['password']);

        $sql = "SELECT * from employe  where mail = '$email' and poste = 'qhse' ";
       //    echo($sql);die;
        $res = $db->query($sql);
        if ($res->num_rows < 1) {
            $error = 'aucun employé a cette adresse';
        } else {
            $user = $res->fetch_object();
            //print_r($user->name);die;
            if ($password==$user->pass) {
                $_SESSION['id'] = $user->id;
                $_SESSION['nom'] = $user->nom;
                 $_SESSION['numero'] = $user->numero;
                $_SESSION['poste'] = $user->poste;
                header('Location: ./dashboard.php');
                exit();
            } else {
                $error = 'email ou mot de passe incorret';
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
                        <h4 class="text-center">Employee Login </h4>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="mail" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="mot de passe">
                            </div>
                            <div class="row">

                                <div class="col col-xs-2">
                                    <button style="float:right" type="submit" name="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                            <div class="new">
                    <p><a href="mdp.php">mot de passe oublié</a> || <a href="../index.php">Acceuil !!</a> </p>
    
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