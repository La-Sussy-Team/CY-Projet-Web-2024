<?php
include "./BackEnd/VerificationConnexionAdmin.php";
include "../Client/BackEnd/LoginDatabase.php";
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['username'])){
        $username = $_GET['username'];
        if ($stmt = $con->prepare('SELECT * FROM login INNER JOIN infopersos ON login.id = infopersos.user_id WHERE username = ?')){
            $stmt -> bind_param('s', $username);
            $stmt -> execute();
            $result = $stmt -> get_result();
            $user = $result -> fetch_assoc();
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
    <link rel="stylesheet" href="../../CSS/Admin/Inscription.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Admin/Modification.js"></script>
</head>
<?php
include "Header.php";
?>
<body>
    <div class="Head" style="display: flex;flex: auto;justify-content: center;"><h1>Gestion de l'utilisateur</h1></div>
    <div class="big-container">
        <div class="register-container">
            <div class="modifie">
                <img id="profilePic" src="../../Assets/Client/ProfileImage/<?php echo $user['imgpath']?>" onclick="document.getElementById('profileImage').click();" style="cursor: pointer;">
                <input type="hidden" id="currentProfileImage" name="currentProfileImage" value="<?php echo $user['imgpath']; ?>">
                <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="loadFile(event)">
                <label for="username">Nom d'utilisateur :</label> <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" readonly><br>
                <label for="email">Email :</label> <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
                <label for="tel">Telephone :</label> <input type="tel" id="tel" name="tel" value="<?php echo $user['phone']; ?>"><br>
                <label for="prenom">Prenom :</label> <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>"><br>
                <label for="nom">Nom :</label> <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"><br>
                <label for="sexe">Sexe :</label> <input type="text" id="sexe" name="sexe" value="<?php echo $user['sexe']; ?>"><br>
                <label for="pays">Pays :</label> <input type="text" id="pays" name="pays" value="<?php echo $user['pays']; ?>"><br>
                <label for="ville">Ville :</label> <input type="text" id="ville" name="ville" value="<?php echo $user['ville']; ?>"><br>
                <label for="adresse">Adresse :</label> <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>"><br>
                <button class="send" id="send">Envoyer les modifications</button>
            </div>
        </div>
        <div class="register-container">
            <div class="modifie" style="display: flex;flex-direction: column;">
                <?php 
                if ($user['isSub'] == 0){
                    echo '<button class="sub">Donner les droits abonné</button>';
                } else {
                    echo '<button class="sub">Retirer les droits abonné</button>';
                }
                if ($user['isAdmin'] == 0){
                    echo '<button class="admin">Donner les droits administrateur</button>';
                } else {
                    echo '<button class="admin">Retirer les droits administrateur</button>';
                }
                if($user['isBanned'] == 0){
                    echo '<button class="ban">Bannir l\'utilisateur</button>';
                } else {
                    echo '<button class="ban">Débannir l\'utilisateur</button>';
                }
                ?>
                <button class="delete">Supprimer l'utilisateur</button>
            </div>
        </div>
    </div>
</body>
</html>