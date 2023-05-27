<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';
include '../phpqrcode/qrlib.php';

if ($_SESSION['poste'] != 'admin') {
    header('Location:./dashboard.php');
    exit;
}



if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "UPDATE qrcode SET deleted_yn = true  WHERE id_emp = '$id'";
    $db->query($sql);

}
$sql1 = "SELECT * FROM qrcode WHERE deleted_yn = false";
$res = $db->query($sql1);
$rap = [];
while ($row = $res->fetch_object()) {
    $rap[] = $row;
}

/*$m= new DateTime();
$p= $m->format('H:i:s');
echo $p ;
echo "//";
echo date("y.m.d");
*/

if (isset($_POST['submit'])) {



    $qrid = $_POST['email'];
    $sql5 = "SELECT * FROM employe where mail ='$qrid' AND deleted_yn = false";
$res = $db->query($sql5);
$i = $res->fetch_object()->id;
    //$p=$re->qr;

   // $i=$ras->id_emp;

    
   
    
    $code= "$i" ;
    
    $filename= md5 ( uniqid ()) . '.png';
    $tempdir= "fichier";
    
    $filepath= "../".$tempdir. "/" . $filename;
    QRcode :: png ($code,$filepath);
 if ( file_exists ($filepath)) {
echo '<img src = "../' .$filepath. '" />' ;

 }
        $rapport = $db->real_escape_string($_POST['email']);
        //$files = $db->real_escape_string($_POST['fichier']);

        
        $sql = "INSERT INTO `qrcode`(`id_emp`, `qr`) 
        VALUES ('$i','$filepath')";
                //echo $sql;die;
        if ($db->query($sql) === true) {
           
            echo '<script>alert("code déposé avec succès")</script>';
            echo "<script>window.location.href ='generation.php'</script>";
            //$msg = "Department added successfully";
        } 
    }


 


?>
<div class="main">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <span class=""> <a href=""><strong></span> QRCODE </strong></a>
        <hr> 
    </div>
     
    <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="row" style="padding-top:20px">
                        
                        <div class="form-group col-md-7">
                            <label for="exampleInputEmail1" style="color:black">Email</label>
                            <input type="textarea" name="email" class="form-control"  placeholder="Entrer l'email de l'employé'">
                        </div>
                        
                        <div class="form-group col-md-5">
                            <label for="exampleInputEmail1" style="color:white">Email</label>
                            <input type="submit" name="submit" class="btn btn-primary" style="width:100%" value="Envoyer">
                        </div>

                    </form>
  
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                            <span class=""> <strong> Liste des QRCODES</span> </strong>
                            <hr>
                        </div>
                    </div>
                    <div class="row" style="padding: 0px 15px">
                        <table class="table table-bordered col-lg-12 col-md-12 col-sm-12 col-xs-12" name="cool">
                            <thead>
                                <th>No</th>
                                <th>Nom de l'employe</th>
                                <th>Poste</th>
                                <th>QR</th>
                                <th>Ouvrir</th>
                                <th>Option</th>
                                
                                <!-- <th>Ouvrir</th>-->
    
                                <!-- <th>Option</th>-->
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($rap as $e) : ?>
                                    <tr>
                                        <td><?php echo $i + 1 ?></td>
                                        <?php $sql = "SELECT * FROM employe WHERE id = '$e->id_emp'";
                                            //echo $sql;die;
                                            $res = $db->query($sql);
                                            $no = $res->fetch_object()->nom;
                                            
                                            
    
                                            ?>
                                        <td><?php echo $no?></td>
                                        <?php $sql = "SELECT * FROM employe WHERE id = '$e->id_emp'";
                                            //echo $sql;die;
                                            $res = $db->query($sql);
                                            $post = $res->fetch_object()->poste;
                                            
                                            
    
                                            ?>
                                        <td><?php echo $post?></td>
                                        <td><?php echo $e->qr?></td>
                                        <td>
                                        <a href="?edit=<?php echo $e->id ?>" class="btn btn-info" OnClick="CallPrint(this.value)" >Voir</a>
                                        </td>
                                        <td>
                                        
                                            <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $e->id_emp ?>" class="btn btn-danger">Supprimer</a>
                                            
                                        </td>
                                    </tr>
                                <?php $i++;endforeach ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->

</div>



    
<script>
function CallPrint(strid) {
var prtContent = document.getElementById("cool");
var WinPrint = window.open('<?php echo $e->qr ?>', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
<?php require_once './footer.php'; ?>