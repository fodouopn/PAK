<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['poste'] != 'admin' ) {
    header('Location:./dashboard.php');
    exit;
}

$id_ad=$_SESSION['id'];


$sql1 = "SELECT * FROM rapport_jour ";
$res = $db->query($sql1);
$rap = [];
while ($row = $res->fetch_object()) {
    $rap[] = $row;
}

$sql5 = "SELECT * FROM rapport_jour  where id_chef=$id_ad ";
$res = $db->query($sql5);
$rz = [];
while ($row = $res->fetch_object()) {
    $rz[] = $row;
}



    



?>

<span class=""> <a href=""><strong></span> Rapport journalier</strong></a>
<div class="main">
    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
       
   <span class=""> <strong> Rapports des ingenieurs</span> </strong>
    <hr>


            <table class="table table-bordered" name="cool">
        <thead>
            <th>No</th>
            <th>Nom du document</th>
            <th>Nom du responsable</th>
            <th>Poste</th>
            <th>Detail</th>
            <th>Date du dépot</th>
            <th>Spécification</th>
            <th>Voir plus</th>
            
            
            

            <!-- <th>Option</th>-->
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($rap as $e) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $e->nom?></td>
                    <?php $sql6 = "SELECT * FROM employe WHERE id ='$e->id_chef'";
                        $res = $db->query($sql6);
                        $name = $res->fetch_object()->nom;
                        ?> 
                    <td><?php echo $name?></td>
                    <?php $sql6 = "SELECT * FROM employe WHERE id ='$e->id_chef'";
                        $res = $db->query($sql6);
                        $po = $res->fetch_object()->poste;
                        ?> 
                    <td><?php echo $po?></td>
                    <td><?php echo $e->rapport?></td>
                    <td><?php echo $e->date?></td>
                    <td><?php if ($e->deleted_yn == 0) { echo "en ligne" ;} elseif($e->deleted_yn == 1) {echo "supprimé";}?></td>
                    
                    <td>
                    <a href="?edit=<?php echo $e->id ?>" class="btn btn-info" OnClick="CallPrint(this.value)" >Ouvrir</a>
                    </td>

                   
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
    
              
        </div>
            </br>
    </div>

    <div class="card col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;padding-top:20px">
        <div class="card-body">
       
   <span class=""> <strong>Mes rapports</span> </strong>
    <hr>
                    <table class="table table-bordered" name="cool">
        <thead>
            <th>No</th>
            <th>Nom du document</th>
            <th>Nom du responsable</th>
            <th>Poste</th>
            <th>Detail</th>
            <th>Date du dépot</th>
            <th>Spécification</th>
            <th>Voir plus</th>
            

            <!-- <th>Option</th>-->
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($rz as $ez) : ?>
                <tr>
                <td><?php echo $i + 1 ?></td>
                    <td><?php echo $ez->nom?></td>
                    <?php $sql6 = "SELECT * FROM utilisateurs  WHERE id ='$ez->id_chef'";
                        $res = $db->query($sql6);
                        $name = $res->fetch_object()->nom;
                        ?> 
                    <td><?php echo $name?></td>
                    <?php $sql6 = "SELECT * FROM utilisateurs WHERE id ='$ez->id_chef'";
                        $res = $db->query($sql6);
                        $po = $res->fetch_object()->poste;
                        ?> 
                    <td><?php echo $po?></td>
                    <td><?php echo $ez->rapport?></td>
                    <td><?php echo $ez->date?></td>
                    <td><?php if ($ez->deleted_yn == 0) { echo "en ligne" ;} elseif($ez->deleted_yn == 1) {echo "supprimé";}?></td>
                    
                    <td>
                    <a href="?edit=<?php echo $ez->id ?>" class="btn btn-info" OnClick="CallPrint(this.value)" >Ouvrir</a>
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
var WinPrint = window.open('../files_upload/<?php echo $e->fichier ?>', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

    
<?php require_once './footer.php'; ?>