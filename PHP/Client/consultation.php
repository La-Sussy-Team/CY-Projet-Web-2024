<?php
include "BackEnd/VerificationConnexion.php";
include './BackEnd/LoginDatabase.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/PageAccueil.css">
    <link rel="stylesheet" href="../../CSS/Header.css">
    <link rel="stylesheet" href="../../CSS/Client/RechercheProfils.css">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
    <link rel="icon" href="../../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Rencontre par affinité naturelle</title>
</head>

<?php
include "Header.php";
?>

<body>
    <div class="result">
        <table class="table">
            <h1 class="recom">Consultation de profils</h1>

<?php


$username = $_SESSION['username'];

$query = "SELECT utilisateur_id FROM estconsulter WHERE autre_utilisateur_id = (SELECT id FROM login WHERE username = '$username')";

$result = mysqli_query($con, $query);
$distances = array();

$agemin = 0;
$agemax = 200;

echo('<div class="flexer"> ');

while ($row = mysqli_fetch_assoc($result)) {
    $distances[] = $row['utilisateur_id'];
}

$listeIds = implode(",", $distances);
$query = "SELECT infopersos.*, login.username FROM infopersos JOIN login ON infopersos.user_id = login.id WHERE user_id IN ($listeIds)";
$result = mysqli_query($con, $query);
    
    foreach ($distances as $user) {      
        $id = $user;
        $query = "SELECT infopersos.*, login.username FROM infopersos JOIN login ON infopersos.user_id = login.id WHERE user_id = '$id'";

        $result = mysqli_query($con, $query);
        $prof = mysqli_fetch_assoc($result);
        if($prof['dateNaissance']!=null){
            $birthdate = new DateTime($prof['dateNaissance']);
            $today = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            if($agemin>$age || $agemax<$age ){
                $verif=0;
            }
        }
        echo('<form action="MonProfil.php" method="post">');
        echo('<input type="hidden" name="username" value="'.$prof['username'].'">');
        echo('<button type="submit" class="profil-trouvé">');
        echo('<img src="../../Assets/Client/ProfileImage/'.$prof["imgpath"].'"class="profil-img" width="200" height="200">');
        echo("<b><p>".$prof['prenom']." ".$prof['nom']."</p></b>");
        echo("<p><u> Genre:</u> ".$prof['sexe']."</p>");
        if($prof['dateNaissance']!=null){
            echo("<p><u> Age:</u> ".$age." ans</p>");
        }
        echo("<p><u> Ville:</u> ".$prof['ville']."</p>");
        echo("<p><u> Pays:</u> ".$prof['pays']."</p>");
        echo('</button>');
        echo('</form>');
                }
        echo("</div>");
            
?>

</table>
    </div>
</body>
</html>