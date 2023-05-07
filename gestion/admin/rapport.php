<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['poste'] != 'admin') {
    header('Location:./dashboard.php');
    exit;
}




$sql1 = "SELECT * FROM rapport_jour";
$res = $db->query($sql1);
$rap = [];
while ($row = $res->fetch_object()) {
    $rap[] = $row;
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
var WinPrint = window.open('../chef/<?php echo $e->fichier ?>', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

    
<?php require_once './footer.php'; ?>