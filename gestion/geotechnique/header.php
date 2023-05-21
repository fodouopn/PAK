<?php
session_start();

if (!isset($_SESSION['nom']) || !isset($_SESSION['numero']) || !isset($_SESSION['poste'])) {
    $_SESSION['error'] = "Tu dois d'abord te connecter";
    header('Location: ./index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>SMC</title>

    <link rel="stylesheet" href="./res/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./res/css/font-awesome.css">
    <link href="./res/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top" style="background-color:">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">Systeme De Management</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                <li>
                        <a role="button"><i class=""></i>Poste </a>
                        <span style="color: lightskyblue"><?php echo $_SESSION['poste'] ?></span>
                    </li>
                    <li>
                        <a role="button"><i class=""></i>Nom </a>
                        <span style="color: lightskyblue"><?php echo $_SESSION['nom'] ?></span>
                    </li>
                    <li><a href="./logout.php"><i class=""></i> Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>