<?php
include "./BackEnd/VerificationConnexion.php";
include './BackEnd/LoginDatabase.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
} else {
    $username = $_SESSION['username'];
}
if ($stmt = $con->prepare('SELECT * FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $login = $result->fetch_assoc();
}
if ($stmt = $con->prepare('SELECT * FROM infopersos WHERE user_id = ?')) {
    $stmt->bind_param('i', $login['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}


$other_user_isSub = 0;
if ($stmt = $con->prepare('SELECT isSub FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $other_user_isSub = $row['isSub'];
}

if ($stmt = $con->prepare('SELECT * FROM relationplante WHERE id = ?')) {
    $stmt->bind_param('i', $login['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $plantid = $result->fetch_assoc();
}

if ($stmt = $con->prepare('SELECT * FROM plante WHERE id = ?')) {
    $stmt->bind_param('i', $plantid['id_plante']);
    $stmt->execute();
    $result = $stmt->get_result();
    $plante = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Mon Profil</title>
    <link rel="stylesheet" href="../../CSS/Client/MonProfil.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
</head>
<?php
include "Header.php";
?>
<body>
    <div class="profile-container">
        <div class="profile-top">
            <div class="profile-pic">
                <img id="profilePic" src="../../Assets/Client/ProfileImage/<?php echo $user['imgpath']?>">
                <?php
                if ($_SESSION['username'] == $username) {
                    echo '<a href="ModifierProfil.php">Modifier mon profil</a>';
                } else if ($_SESSION['isSub'] != 0 && $other_user_isSub!=0) {
                echo '
                    <form method="POST" action="create_conversation.php">
                        <input type="hidden" name="username2" value="' . $_SESSION['username'] . '">
                        <input type="hidden" name="username" value="' . $username . '">
                        <button type="submit">Créer la conversation</button>
                    </form>';
                }
                ?>
                </form>
            </div>
            <div class="profile-info">
                <div class="identity">
                    <b><u><h3><?php echo ($user['prenom']." ".$user['nom']); ?></h3></u></b>
                </div>
                <div class="info">
                    <p><u>Tel:</u> <?php echo $user['phone']; ?></p>
                    <p><u>Sexe:</u> <?php echo $user['sexe']; ?></p>
                    <p><u>Date de naissance:</u> <?php echo $user['dateNaissance']; ?></p>
                    <p><u>Pays:</u> <?php echo $user['pays']; ?></p>
                    <p><u>Ville:</u> <?php echo $user['ville']; ?></p>
                    <p><u>Centre d'intérets:</u> <?php echo str_replace("~"," - ",$user['interets']); ?></p>
                </div>
            </div>
        </div>
        <div class="profile-mid">
            <u><h1 style="text-align: center;">Description</h1></u>
            <p style="word-wrap: anywhere;"><?php echo $user['bio']; ?></p>
        </div>
        <div class="profile-bot">
            <div class="desc-plant">
                <p> <?php echo($plante['description']) ?></p>
            </div>
            <div class="id-plant">
                <div class="nom-plant">
                    <h2 style="text-align: center;"><?php echo($plante['plante']) ?></h2>
                </div>
                <div class="img-plant">
                    <?php echo("<img src='../../Assets/Client/Plante/".$plante['imgpath']."'>"); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>