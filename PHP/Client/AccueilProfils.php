<?php
include "./BackEnd/VerificationConnexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Accueil Profils</title>
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
</head>
<?php
include "Header.php";
?>
<body>
    <form action="Deconnexion.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>