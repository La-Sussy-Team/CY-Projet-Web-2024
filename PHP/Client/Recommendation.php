<?php
include "BackEnd/VerificationConnexion.php";
include './BackEnd/LoginDatabase.php';
function calculateCompatibility($distance) {
    if ($distance <= 0.5) {
        return 100;
    } else if ($distance >= 3) {
        return 0;
    } else {
        return round(120-($distance*40),0);
    }
}
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
            <?php
                $username = $_SESSION['username'];
                $query = "SELECT id FROM login WHERE username = '$username'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $query = "SELECT x, y FROM relationplante WHERE  id = '$id'";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $current_user_x = $row['x'];
                $current_user_y = $row['y'];
                $query = "SELECT id, x, y FROM relationplante";
                $result = mysqli_query($con, $query);
                $distances = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['x'] != null && $row['y'] != null){
                        $distance = sqrt(pow($row['x'] - $current_user_x, 2) + pow($row['y'] - $current_user_y, 2));
                        $distances[] = array('id' => $row['id'], 'distance' => $distance);
                    }
                }
                usort($distances, function($a, $b) {
                    return $a['distance'] - $b['distance'];
                });
                $closest_users = array_slice($distances, 0, 4);
            ?>
            <h1 class="recom">Recommendations de profils</h1>
            <?php
                $agemin=0;
                $agemax=200;
                echo('<div class="flexer"> ');
                foreach ($closest_users as $user) {
                    $id = $user['id'];
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
                    echo("<p><u> Compatibilité:</u> ".calculateCompatibility($user['distance'])."%</p>");
                    echo('</button>');
                    echo('</form>');
                }
                echo("</div>");
            ?>
        </table>
    </div>
</body>
</html>
