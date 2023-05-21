<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
// Array with names
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";

// get the q parameter from URL
$q = $_REQUEST["q"];
require_once '../admin/src/database.php';
//$hint = "";
//$con = mysqli_connect('localhost','root','','hr');
// Check connection
/*if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}*/
// lookup all hints from array if $q is different from ""
if ($q ) {
  $e=date("Y-m-d H:i:s ");
  $es=date(date("Y").date("m").date("d")+1 );
 
 
  
  /*$q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }*/
  /*$sql = "SELECT  from horaire  WHERE id='$q'";
  $res = $db->query($sql);*/
/*$re = mysqli_query($con,"SELECT entree_sortie FROM horaire WHERE id='$q'");
$res = mysqli_fetch_assoc($re);*/

  
  

  /*$sql1 = "SELECT * from horaire ";
  $res1 = $db->query($sql1);
  $np1 = $res1->fetch_object()->temps_entree; 

$sql = "SELECT * from horaire  WHERE id_emp='$q'";
$res = $db->query($sql);
//$n = $res->fetch_object()->entree_sortie;
$nr = $res->fetch_object()->temps_sortie;
$np = $res->fetch_object()->temps_entree;*/
//$nt = $res->fetch_object()->id_emp;
//$mp = $res->fetch_object()->id_hor;
/*$ne = $ne->format('Y-m-d');
echo "$n";
echo "$nr";
echo "$nt";*/

/*$sql1 = "SELECT * from horaire  ";
$res1 = $db->query($sql1);
$mp = $res1->fetch_object()->id_hor;
//$nr = $res1->fetch_object()->temps_sortie;
$np = $res1->fetch_object()->temps_entree;*/





$sql = "SELECT * FROM horaire  WHERE id_emp='$q'  and entree_sortie = 1  ";
  $res = $db->query($sql);
 

$num =$res->num_rows;
if ($num>0){
  //echo "$num";
  //echo 'il existe déja '.$num.' exemplaires';
  
  $mp = $res->fetch_object()->id_hor;
  //echo "$mp";
  
  $re="UPDATE `horaire` SET `temps_sortie`=NOW(),`entree_sortie`='2' WHERE  id_emp='$q' and id_hor ='$mp'  ";
  $resu = $db->query($re);
  if ( $db->query($re)  ){
  
    echo "Départ.......Fin de journée";
  }

  

}else{

  $ret="INSERT INTO  `horaire`(temps_entree,id_emp,entree_sortie) VALUES (NOW(),'$q',1)";
  $resul = $db->query($ret);
  echo "Arrivée.... Début de journée";
}
  
    
 

    
    
 

/*$result=mysqli_query($con,"SELECT * FROM employe WHERE id='$q'");
$rowcount=mysqli_num_rows($result);
$sql2 = "SELECT * FROM horaire  WHERE id_emp='$q' and 'date'>=  $e   and 'date'< $es and entree_sortie = 1  ";
$res = $db->query($sql2);
$mp = $res->fetch_object()->id_hor;
if( $res = true ){*/





//$mz = $res->fetch_object()->entree_sortie;



  
  //$nr = $res1->fetch_object()->temps_sortie;
  //$np = $res->fetch_object()->temps_entree;
  
  /*$sql = "SELECT * FROM horaire  WHERE id_emp='$q' ";
  $res = $db->query($sql);
  
  $mp = $res->fetch_object()->id_hor;
  $m= date_create($m);
  $m = date_format($m,'H:i:s ');
  echo $m ;*/
  //and 'date'>=  $e   and 'date'< $es
  
  
  

}



/*else{
//echo 'employee is already registered';  
echo '<div class="alert alert-success"><strong>Success!</strong> employee successfully registered</div>';
echo date('l jS \of F Y h:i:s A');

  }*/



// Output "no suggestion" if no hint was found or output correct values
//echo $hint === "" ? "no suggestion" : $hint;
?>