<?php
$countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Côte d'Ivoire", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia (Czech Republic)", "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. Swaziland)", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Holy See", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia (formerly Macedonia)", "Norway", "Oman", "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];
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
    <title>PersonalyTree - Modification Profil</title>
    <link rel="stylesheet" href="../../CSS/Client/ModifierProfil.css">
    <link rel="stylesheet" href="../../CSS/Client/Inscription.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Client/Modification.js"></script>
</head>
<?php
include "Header.php";
?>
<body>
    <div class="register-container">
        <div class="modifie">
            <img id="profilePic" src="../../Assets/Client/ProfileImage/<?php echo $user['imgpath']?>" onclick="document.getElementById('profileImage').click();" style="cursor: pointer;">
            <input type="hidden" id="currentProfileImage" name="currentProfileImage" value="<?php echo $user['imgpath']; ?>">
            <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="loadFile(event)">
            <label for="currentPassword">Mot de passe actuel :</label> <input type="password" id="currentPassword" name="currentPassword" required><br>
            <label for="username">Nom d'utilisateur :</label> <input type="text" id="username" name="username" value="<?php echo $login['username']; ?>" readonly><br>
            <label for="email">Email :</label> <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>
            <label for="tel">Telephone :</label> <input type="tel" id="tel" name="tel" value="<?php echo $user['phone']; ?>"><br>
            <label for="password">Nouveau mot de passe :</label> <input type="password" id="password" name="password"><br>
            <label for="passwordConfirmation">Confirmer mot de passe :</label> <input type="password" id="passwordConfirmation" name="passwordConfirmation"><br>
            <label for="prenom">Prenom :</label> <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>"><br>
            <label for="nom">Nom :</label> <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>"><br>
            <label for="sexe">Sexe :</label> 
            <select name="sexe" id="sexe">
                <option value="Homme" <?php if ($user['sexe'] == 'Homme') echo 'selected'; ?>>Homme</option>
                <option value="Femme" <?php if ($user['sexe'] == 'Femme') echo 'selected'; ?>>Femme</option>
                <option value="Autre" <?php if ($user['sexe'] == 'Autre') echo 'selected'; ?>>Autre</option>
            </select><br>
            <label for="dateNaissance">Date de naissance :</label> <input type="date" name="dateNaissance" id="dateNaissance" value="<?php echo date('Y-m-d', strtotime($user['dateNaissance'])); ?>" required><br>
            <label for="pays">Pays :</label> 
            <select name="pays" id="pays">
                <?php foreach ($countries as $country): ?>
                    <option value="<?= $country ?>" <?php if ($user['pays'] == $country) echo 'selected'; ?>><?= $country ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="ville">Ville :</label> <input type="text" id="ville" name="ville" value="<?php echo $user['ville']; ?>"><br>
            <label for="adresse">Adresse :</label> <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>"><br>
            <label for="bio">Biographie :</label> <textarea name="bio" id="bio" required><?php echo $user['bio']; ?></textarea><br>
            <label for="interets">Centres d'intérêts :</label> <input type="text" id="interets" name="interets" placeholder="Appuyer sur Entrer pour ajouter le centre d'intérêt" required><ul id="keywords"></ul><input type="hidden" name="interets" id="hiddenInterests" value="<?php echo $user['interets']; ?>"><br>
            <button class="send" id="send">Envoyer les modifications</button>
        </div>
    </div>
</body>
</html>
