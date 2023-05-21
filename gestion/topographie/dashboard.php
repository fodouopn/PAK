<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class=""></span>Mon tableau</strong></a>
    <hr>
    <h2 >Bienvenue: <span class="text-primary"><?php echo $_SESSION['nom']?> </span></h2>
    <?php
      $dept_id = $_SESSION['id'];
     $sql = "SELECT * FROM employe where id = '$dept_id'";
      $res = $db->query($sql);
      //$dept = $res->fetch_object()->name;
     ?>
    <h4>POSTE:  <?php echo $_SESSION['poste'] ?></h4>

</div>

<?php require_once './footer.php';?>