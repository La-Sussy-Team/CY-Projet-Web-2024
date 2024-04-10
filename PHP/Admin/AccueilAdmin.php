<?php
include "./BackEnd/VerificationConnexionAdmin.php";
include "../Client/BackEnd/LoginDatabase.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>Accueil Administrateur</title>
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
</head>
<?php
include "Header.php";
?>
<body>
    <div style="display:flex; flex-direction:column; text-align:center; position:relative; top: 8vh;">
        <h1>Bienvenue dans le paneau de gestion administrateur</h1>
        <h3>Choisissez une catégorie dans le menu ci-dessus</h3>
        <h2>Statistiques actuelles du site</h2>
        <p>Nombre d'utilisateurs inscrits : <?php
        if ($stmt = $con->prepare('SELECT COUNT(*) FROM login')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $users = $result -> fetch_all(MYSQLI_ASSOC);
            echo $users[0]['COUNT(*)'];
        }
        ?></p>
        <p>Nombre d'utilisateurs abonnés : <?php
        if ($stmt = $con->prepare('SELECT COUNT(*) FROM login WHERE isSub = 1')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $users = $result -> fetch_all(MYSQLI_ASSOC);
            echo $users[0]['COUNT(*)'];
        }
        ?></p>
        <p>Nombre d'utilisateurs administrateurs : <?php
        if ($stmt = $con->prepare('SELECT COUNT(*) FROM login WHERE isAdmin = 1')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $users = $result -> fetch_all(MYSQLI_ASSOC);
            echo $users[0]['COUNT(*)'];
        }
        ?></p>
        <p>Nombre d'utilisateurs bannis : <?php
        if ($stmt = $con->prepare('SELECT COUNT(*) FROM login WHERE isBanned = 1')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $users = $result -> fetch_all(MYSQLI_ASSOC);
            echo $users[0]['COUNT(*)'];
        }
        ?></p>
        <p>Nombre de messages signalés à traiter : <?php
        if ($stmt = $con->prepare('SELECT COUNT(*) FROM messages WHERE isReported = 1')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $messages = $result -> fetch_all(MYSQLI_ASSOC);
            echo $messages[0]['COUNT(*)'];
        }
        ?></p>
    </div>
</body>
</html>