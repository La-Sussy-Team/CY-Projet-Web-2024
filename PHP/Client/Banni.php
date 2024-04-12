<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Connexion.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Utilisateur Banni</title>
    <link rel="stylesheet" href="../../CSS/Client/Banni.css">
</head>
<?php
include "Header.php";
?>
<body>
    <div class="master">
        <div class="login-container">
            <h2>Vous avez été banni</h2>
            <img src="../../Assets/Logo/Banned.png" alt="Logo PersonaliTree" style="width: 20vw; height: 20vw; margin-top: 2vh;">
            <p style="color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;">Vous avez été banni de PersonaliTree, vous ne pouvez plus accéder aux fonctionnalités du site. Pour plus d'informations ou demander un débanissement, veuillez contacter le support.</p>
        </div>
    </div>
</body>
</html>
