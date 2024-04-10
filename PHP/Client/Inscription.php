<?php
session_start();
$countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Côte d'Ivoire", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia (Czech Republic)", "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. Swaziland)", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Holy See", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia (formerly Macedonia)", "Norway", "Oman", "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Inscription</title>
    <link rel="stylesheet" href="../../CSS/Client/Inscription2.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Client/Inscription.js"></script>
</head>
<body>
    <div class="overlay" id="overlay"></div>
	<div class="ilotValider" id="ilotValider">
		<h2>Votre inscription a bien été validé !</h2>
		<div class="validation-animation" id="validationAnimation">
			<img src="../../Assets/Animation/validation.gif">
		</div>
		<h2>Vous pouvez à présent vous connecter</h2>
	</div>
    <div class="container">
        <div class="step active" id="step1">
            <img id="profilePic" src="../../Assets/Client/ProfileImage/default.jpg" onclick="document.getElementById('profileImage').click();" style="cursor: pointer; width: 300px; height: 300px;">
            <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="loadFile(event)">
            <label for="username"><h3>Nom d'utilisateur :</h3></label>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required autocomplete="username" pattern="[A-Za-z0-9]+">
            <?php 
            if (isset($_SESSION['error'])){
                if ($_SESSION['error'] == 1) {
                    echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Le nom d'utilisateur ne doit contenir que des lettres et chiffres</p>";
                } else if ($_SESSION['error'] == 2){
                    echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Nom d'utilisateur déjà utilisé</p>";
                }
                unset($_SESSION['error']);
            }
            ?>
            <button class="next">Suivant</button>
            <a href="Connexion.php" class="alien">Déjà inscrit ? <b>Connectez-vous!</b></a>>
        </div>
        <div class="step" id="step2">
            <label for="username"><h3>Adresse email :</h3></label>
            <input type="text" name="email" id="email" placeholder="bob.madison@gmail.com" required autocomplete="username" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
            <label for="phone"><h3>Numéro de téléphone :</h3></label>
            <input type="tel" name="tel" id="tel" placeholder="06 12 34 56 78" required autocomplete="tel" pattern="[0-9]{10}">
            <label for="password"><h3>Mot de passe :</h3></label>
            <input type="password" name="password" id="password" required autocomplete="current-password">
            <label for="passwordConfirmation"><h3>Confirmer le mot de passe :</h3></label>
            <input type="password" name="passwordConfirmation" id="passwordConfirmation" required autocomplete="current-password">
            <?php
            if (isset($_SESSION['error'])){
                if ($_SESSION['error'] == 3){
                        echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Les mots de passe ne correspondent pas</p>";
                    } else if ($_SESSION['error'] == 4){
                        echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Erreur SQL</p>"; //debug
                    }
                    unset($_SESSION['error']);
                }
                ?>
            <button class="prev">Précédent</button>
            <button class="next">Suivant</button>
        </div>
        <div class="step" id="step3">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            <label for="sexe">Sexe :</label>
            <select name="sexe" id="sexe">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
            </select>
            <button class="prev">Précédent</button>
            <button class="next">Suivant</button>
        </div>
        <div class="step" id="step4">
            <label for="pays">Pays :</label>
            <select name="pays" id="pays">
                <?php foreach ($countries as $country): ?>
                    <option value="<?= $country ?>"><?= $country ?></option>
                <?php endforeach; ?>
            </select>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" required>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
            <button class="prev">Précédent</button>
            <button class="send" id="send">S'inscrire</button>
        </div>
    </div>
</body>
</html>
