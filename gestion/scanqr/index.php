


<!doctype html>
<html lang="en">
<?php  require_once '../admin/src/database.php' ?>
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
                
                        
            <script src="ht.js"></script>
<style>
  .result{
    background-color: blue;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
</style>
<div class="row">
  <div class="col">
    <div style="width:500px;" id="reader"></div>
  </div><audio id="myAudio1">
  <source src="success.mp3" type="audio/ogg">
</audio>
<audio id="myAudio2">
  <source src="failes.mp3" type="audio/ogg">
</audio>
<script>
var x = document.getElementById("myAudio1");
var x2 = document.getElementById("myAudio2");      
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "q=" + str, true);
    
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}

function playAudio() { 
  x.play(); 
} 
 

  </script>
  <div class="col" style="padding:30px;">
    <h4>RESULTAT SCAN</h4>
    <div>Nom employee </div><form action="index.php">
     <input type="text" name="start" class="input" id="result"  
      onkeyup="showHint(this.value)"
      placeholder="resultat" readonly="" />
     </form>

     <p>Status: <span id="txtHint"></span></p>
  </div>
  
  <div class="new">
                    <a href="../index.php">Acceuil !!</a> </p>
    
                    </div> 
</div>

<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    document.getElementById("result").value = qrCodeMessage;
    
    
  
  showHint(qrCodeMessage);
playAudio();

}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>      

     
            </div>

        </div>
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../resources/js/jquery-3.6.0.min.js"></script>
    <script src="./res/js/popper.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>
</body>

</html>
