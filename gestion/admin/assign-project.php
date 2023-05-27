<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

/*
$sql = "SELECT * FROM department";
$res = $db->query($sql);
$departments = [];
while($row = $res->fetch_object()){
    $departments [] = $row;
}*/

$sql = "SELECT * FROM employe";
$res = $db->query($sql);
$employe = [];
while($row = $res->fetch_object()){
    $employe [] = $row;
}


$sql = "SELECT * FROM tache";
$res = $db->query($sql);
$tache = [];
while($row = $res->fetch_object()){
    $tache [] = $row;
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if ( $_POST['employe'] == 'none') {

        $error = "select employé";
    }else if ( $_POST['tache'] == 'none') {

        $error = "select tache";
    } 
     else {

        //$department = $db->real_escape_string($_POST['department']);
        $employe = $db->real_escape_string($_POST['employe']);
        $tache = $db->real_escape_string($_POST['tache']);
       
        $sql = "INSERT INTO assignation
                (id_tache, id_emp)
                values ('$tache',  '$employe')";
                
        if ($db->query($sql) === true) {
            
            
 echo '<script>alert("Assignation du projet reussit")</script>';
 echo "<script>window.location.href ='assign-project.php'</script>";

        } else {
            
            echo '<script>alert("Une erreure est survenue, veuillez réessayer")</script>';
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class=""> <a href="./assigned-project-index.php">Retour  /</span></strong></a>
   <span class="fa fa-dashboard"> <a href=""><strong></span> Assigné une tache</strong></a>
   
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                    

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        
                   
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Employé</label>
                          <select class="form-control" id="employe" name="employe">
                                <option value="none">--Sélectionner l'employé--</option>
                                <?php foreach($employe as $e): ?>
                                <option value="<?php echo $e->id ?>"><?php echo $e->nom ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Tache</label>
                            <select class="form-control" id="project" name="tache">
                                <option value="none">--Sélectionner la tache--</option>
                                <?php foreach($tache as $p): ?>
                                <option value="<?php echo $p->id ?>"><?php echo $p->nom_tache ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                      
                       
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">envoyer</button>
                            <a href="assigned-project-index.php"><button type="button" class="btn btn-primary">Annuler</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>
 <script>
    const department = document.querySelector('#department');
    const employe = document.querySelector('#employe');
    const project = document.querySelector('#project');
    department.addEventListener('change', function() {
    let value = this.value;
    //console.log(value);
    var params = new URLSearchParams();
    params.append('department', value);
    fetch('../api/getemployes.php', {
    method: 'POST',
    headers: {
    "Content-Type": "application/x-www-form-urlencoded"
    },
    body: params
    })
    .then(function(response) {
    return response.json();
    })
    .then(json => {
    console.log(json);
    employe.innerHTML = '<option value="none">--SELECT employe--</option>';
    json.forEach(emp => {
    employe.innerHTML += '<option value="' + emp.id + '">' + emp.name +
    '</option>';

    });
    })
    .catch(function(error) {
    console.log(error);
    })
    })
    </script>