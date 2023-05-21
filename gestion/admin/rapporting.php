<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['poste'] != 'admin') {
    header('Location:./dashboard.php');
    exit;
}



$et=date('Y-m-d');
//echo "$et ok";

if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql8 = "SELECT * FROM rapport_jour  WHERE id='$id'";
    $res = $db->query($sql8);
    $m = $res->fetch_object()->date;
    $m= date_create($m);
    $m = date_format($m,"Y-m-d");
    
    if($et == $m){
        $id = $db->real_escape_string($_GET['delete']);
        $sql = "DELETE FROM rapport_jour WHERE id = '$id'";
        $db->query($sql);
        echo '<script>alert("Rapport supprimé avec succès")</script>';
        echo "<script>window.location.href ='rapport.php'</script>";
        
       
       
       
    }else{
        
        echo '<script>alert("La date de modification est passée, Impossible de supprimer le rapport")</script>';
        echo "<script>window.location.href ='rapport.php'</script>";
        
       
        
    }
   
}
$ur=$_SESSION['id'];
$sql1 = "SELECT * FROM rapport_jour where id_chef = $ur";
$res = $db->query($sql1);
$rap = [];
while ($row = $res->fetch_object()) {
    $rap[] = $row;
}


if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    $ur=$_SESSION['id'];
    $no=$_SESSION['nom'];

        $rapport = $db->real_escape_string($_POST['rapport']);
        //$files = $db->real_escape_string($_POST['fichier']);

        
        $sql = "INSERT INTO `rapport_jour`(`id_chef`, `rapport`) 
        VALUES ('$ur','$rapport')";
                //echo $sql;die;
        if ($db->query($sql) === true) {
            require('upload.php');
            echo '<script>alert("Rapport déposé avec succes")</script>';
            echo "<script>window.location.href ='rapport.php'</script>";
            //$msg = "Department added successfully";
        } 
    }


    
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class=""> <a href=""><strong></span> Rapport </strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Rapport</label>
                            <input type="textarea" name="rapport" class="form-control"  placeholder="Entrer le Détail">
                        </div>
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
                        <input type="file" name="files" id="files"  required/>
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                            
                        </div>


                    </form>


                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class=""> <strong> Liste des rapports</span> </strong>
    <hr>


</div>
                    <table class="table table-bordered" name="cool">
        <thead>
            <th>No</th>
            <th>Nom du document</th>
            <th>Detail</th>
            <th>Date</th>
            <th>Voir plus</th>
            <th>Option</th>
            

            <!-- <th>Option</th>-->
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($rap as $e) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $e->nom?></td>
                    <td><?php echo $e->rapport?></td>
                    <td><?php echo $e->date?></td>
                    
                    <td>
                    <a href="?edit=<?php echo $e->id ?>" class="btn btn-info" OnClick="CallPrint(this.value)" >Ouvrir</a>
                    </td>

                   <td>

                  
                        <a onclick='return confirm("Etes-vous sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $e->id ?>" class="btn btn-danger">Supprimer</a>
                        
                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function CallPrint(strid) {
var prtContent = document.getElementById("cool");
var WinPrint = window.open('<?php echo $e->fichier ?>', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

    
<?php require_once './footer.php'; ?>