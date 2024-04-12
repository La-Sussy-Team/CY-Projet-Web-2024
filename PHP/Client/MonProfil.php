<?php
include "./BackEnd/VerificationConnexion.php";
include './BackEnd/LoginDatabase.php';
if ($stmt = $con->prepare('SELECT * FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $_SESSION['username']);
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
                <button class="contact-button" name="me contacter">
            </div>
            <div class="profile-info">
                <div class="identity">
                    <h3><?php echo ($user['prenom']." ".$user['nom']); ?></h3>
                </div>
                <div class="info">
                    <p>Tel: <?php echo $user['phone']; ?></p>
                    <p>Sexe: <?php echo $user['sexe']; ?></p>
                    <p>Pays: <?php echo $user['pays']; ?></p>
                    <p>Ville: <?php echo $user['ville']; ?></p>
                    <p>Ville: <?php echo $user['ville']; ?></p>

                </div>
            </div>
        </div>
        <div class="profile-mid">
            <p>Tel: <?php echo $user['bio']; ?></p>
        </div>
        <div class="profile-bot">
            <div class="desc-plant">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum eveniet non ad amet atque, fugit dolor tenetur quam repellendus doloribus inventore, modi ipsa. Dolor, sapiente. Neque autem eaque cum modi.</p>
            </div>
            <div class="id-plant">
                <div class="nom-plant">
                <p>a l'aide</p>
                </div>
                <div class="img-plant">
                <p>a</p>
                </div>
            </div>
        </div>
            <form action="Deconnexion.php" method="POST">
                <!--<button type="submit">Logout</button>-->
            </form>
           <!-- <a href="ModifierProfil.php">Modifier mon profil</a>-->
        </div>
    </div>
</body>
</html>