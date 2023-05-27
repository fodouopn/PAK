<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['poste'] != 'admin') {
    header('Location:./dashboard.php');
    exit;
}


?>
 <a href="#"><strong><span class=""></span> Appréciation</strong></a>
                    <hr>
                </div>
                <br>
                <br>
             
<div class="main">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            
        <strong><span class=""></span> Note</strong>
                    <hr>
                
                
    <?php


// Récupération des postes dans la table "employe"
$resultat_postes = $db->query("SELECT * FROM employe ");
$postes = [];


  


// Affichage de la première sélection avec les postes
echo "<form method='post' action='' >";
echo "<label for='poste'>Poste :</label>";
echo "<select id='poste' name='poste'>";

while ($row_poste = $resultat_postes->fetch_object()) {
    
    echo "<option value='" . $row_poste->id . "'>" . $row_poste->poste . "</option>";
}
echo "</select>";

// Récupération des rapports en rapport avec le poste sélectionné dans la table "rapport"
if (isset($_POST["poste"])) {
    $poste_selectionne = $_POST["poste"];
    $resultat_rapports = $db->query("SELECT * FROM rapport_jour WHERE id_chef = '$poste_selectionne'  ");
    
    $post = [];
    
    // Vérification du résultat
    if (!$resultat_rapports) {
        echo "Echec de la requête : " . $db->error;
        exit();
    }

    // Affichage de la deuxième sélection avec les rapports en rapport avec le poste sélectionné
    echo "<br>";
    echo "<label for='rapport'>Rapport :</label>";
    echo "<select id='rapport' name='rapport'>";
   
    while ($row_rapport =  $resultat_rapports->fetch_object()) {
        echo "<option value='" . $row_rapport->id . "'>" . $row_rapport->nom . "</option>";
    }
    echo "</select>";

    // Affichage de la case de note
    echo "<br>";
    echo "<label for='note'>Note :</label>";
    echo "<input type='number' id='note' name='note' min='0' max='20'>";
}

// Soumission du formulaire et insertion des données dans la table "evaluation"
if (isset($_POST["poste"]) && isset($_POST["rapport"]) && isset($_POST["note"])) {
    $poste_selectionne = $_POST["poste"];
    $rapport_selectionne = $_POST["rapport"];
    $note_attribuee = $_POST["note"];

    // Insertion des données dans la table "evaluation"
    $resultat_insertion = $db->query("INSERT INTO evaluation (id_emp, id_rapport, notes) VALUES ('$poste_selectionne', '$rapport_selectionne', $note_attribuee)");

    // Vérification du résultat
    

    echo "<br>";
    
    echo '<script>alert("Ajout avec succes")</script>';
    echo "<script>window.location.href ='notation.php'</script>";
    
}

echo "<br>";
echo "<input type='submit' value='Soumettre'>";
echo "</form>";

// Fermeture de la connexion

?>
               
                <!-- </div> -->
            
        </div>
    </div>
</div>
<?php require_once './footer.php'; ?>