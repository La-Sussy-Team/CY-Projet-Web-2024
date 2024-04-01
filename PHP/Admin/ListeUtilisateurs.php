<?php
include "./BackEnd/VerificationConnexionAdmin.php";
//include "MenuAdmin.php";
include "../Client/BackEnd/LoginDatabase.php";
if ($stmt = $con->prepare('SELECT * FROM login INNER JOIN infopersos ON login.id = infopersos.user_id')){
    $stmt -> execute();
    $result = $stmt -> get_result();
    $users = $result -> fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0" />
    <title>Personalytree - Administration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <link rel="stylesheet" href="../../CSS/Admin/StylesCommuns.css">
    <link rel="stylesheet" href="../../CSS/Admin/ListeUtilisateurs.css">
</head>
<body>
    <div class="Head" style="display: flex;flex: auto;justify-content: center;"><h1>Gestion des utilisateurs</h1></div>
    <div class="flexer">
        <?php foreach ($users as $user): ?>
            <div class="card">
                <img src="../../Assets/Client/ProfileImage/<?php echo $user['imgpath']?>" alt="<?php echo $user['username']; ?>" style="width: 300px;">
                <h1><?php echo $user['username']; ?></h1>
                <p class="title"><?php echo $user['prenom'] . ' ' . $user['nom'] ?></p>
                <p><?php echo $user['sexe'] ?></p>
                <p>Est abonné : <?php echo $user['isSub'] ? 'Oui' : 'Non' ?></p>
                <p>Est admin : <?php echo $user['isAdmin'] ? 'Oui' : 'Non' ?></p>
                <p>
                    <a href="GestionUtilisateur.php?username=<?php echo urlencode($user['username']); ?>">
                        <button>Gérer</button>
                    </a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>
</html>