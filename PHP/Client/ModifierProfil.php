<?php
session_start();
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
    <title>PersonaliTree - Modification Profil</title>
    <link rel="stylesheet" href="../../CSS/Client/Modification.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Client/Modification.js"></script>
</head>
<body>
    <img id="profilePic" src="../../Assets/Client/ProfileImage/<?php echo $user['imgpath']?>" onclick="document.getElementById('profileImage').click();" style="cursor: pointer;">
    <input type="hidden" id="currentProfileImage" name="currentProfileImage" value="<?php echo $user['imgpath']; ?>">
    <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="loadFile(event)">
    <label for="currentPassword">Current Password:</label> <input type="password" id="currentPassword" name="currentPassword" required><br>
    <label for="username">Username:</label> <input type="text" id="username" name="username" value="<?php echo $login['username']; ?>" readonly><br>
    <label for="email">Email:</label> <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
    <label for="tel">Tel:</label> <input type="tel" id="tel" name="tel" value="<?php echo $user['phone']; ?>"><br>
    <label for="password">New Password:</label> <input type="password" id="password" name="password"><br>
    <label for="passwordConfirmation">Confirm New Password:</label> <input type="password" id="passwordConfirmation" name="passwordConfirmation"><br>
    <label for="prenom">Prenom:</label> <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>"><br>
    <label for="nom">Nom:</label> <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"><br>
    <label for="sexe">Sexe:</label> <input type="text" id="sexe" name="sexe" value="<?php echo $user['sexe']; ?>"><br>
    <label for="pays">Pays:</label> <input type="text" id="pays" name="pays" value="<?php echo $user['pays']; ?>"><br>
    <label for="ville">Ville:</label> <input type="text" id="ville" name="ville" value="<?php echo $user['ville']; ?>"><br>
    <label for="adresse">Adresse:</label> <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>"><br>
    <button class="send" id="send">Envoyer les modifications</button>
</body>
</html>