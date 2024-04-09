<?php
include "./BackEnd/VerificationConnexionAdmin.php";
include "../Client/BackEnd/LoginDatabase.php";
include "Header.php";
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if ($stmt = $con->prepare('SELECT * FROM login INNER JOIN infopersos ON login.id = infopersos.user_id')){
            $stmt -> execute();
            $result = $stmt -> get_result();
            $users = $result -> fetch_all(MYSQLI_ASSOC);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0" />
    <title>Personalytree - Administration</title>
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <link rel="stylesheet" href="../../CSS/Admin/StylesCommuns.css">
    <link rel="stylesheet" href="../../CSS/Admin/GestionUtilisateur.css">
</head>
<body>
    <div class="Head" style="display: flex;flex: auto;justify-content: center;"><h1>Gestion de l'utilisateur</h1></div>
    <div class="flexer">
        
    </div>
</body>
</html>