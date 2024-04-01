<?php
include "./BackEnd/VerificationConnexionAdmin.php";
include "MenuAdmin.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Administrateur</title>
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
</head>
<body>
    <div style="display:flex; flex-direction:column; text-align:center; position:relative; top: 8vh;">
        <h1>Bienvenue <?php echo $_SESSION['username']." !" ?></h1>
        <h3>Choisissez une catégorie à modifier</h3>
    </div>
</body>
</html>