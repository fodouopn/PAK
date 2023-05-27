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
        $sql = "UPDATE rapport_jour SET deleted_yn = true WHERE id = '$id'";
        $db->query($sql);
        echo '<script>alert("Rapport supprimé avec succès")</script>';
        echo "<script>window.location.href ='rapport.php'</script>";
        
       
       
       
    }else{
        
        echo '<script>alert("La date de modification est passée, Impossible de supprimer le rapport")</script>';
        echo "<script>window.location.href ='rapport.php'</script>";
        
       
        
    }
   
}
$ur=$_SESSION['id'];
$sql1 = "SELECT * FROM rapport_jour where id_chef = $ur and deleted_yn = false";
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
            echo "<script>window.location.href ='rapporting.php'</script>";
            //$msg = "Department added successfully";
        } 
    }


    
?> 

<span class=""> <a href=""><strong></span> Rapport journalier</strong></a>
<div class="main">
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
        <span class=""> <strong> Dépot de rapport</span> </strong>
    <hr>
           

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Rapport</label>
                            <input type="textarea" name="rapport" class="form-control"  placeholder="Entrer le Détail">
                        </div>
                        <input type="file" name="files" id="files"  required/>
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                            
                        </div>


                    </form>

                    </div>
</br>
</br>
                    </div>
                    </br>

    
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
       
   <span class=""> <strong> Liste des rapports</span> </strong>
    <hr>
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
            </br>
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