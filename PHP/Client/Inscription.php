<?php
session_start();

$countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Côte d'Ivoire", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czechia (Czech Republic)", "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. Swaziland)", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Holy See", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar (formerly Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia (formerly Macedonia)", "Norway", "Oman", "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];
if (!(!isset($_POST['username'], $_POST['password'], $_POST['passwordConfirmation']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']))){
    if (!preg_match("/^[A-Za-z0-9]+$/", $_POST['username'])) {
        $_SESSION['error'] = 1; //erreur caractères spéciaux
        header('Location: Inscription.php');
        exit();
    }
    include 'BackEnd/LoginDatabase.php';
    if ($_POST['password'] !== $_POST['passwordConfirmation']) {
        $_SESSION['error'] = 3; //erreur mots de passe différents
            header('Location: Inscription.php');
            exit();
    }
    if ($stmt = $con->prepare('SELECT id, password FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = 2; //erreur nom d'utilisateur déjà utilisé
            header('Location: Inscription.php');
            exit();
        } else {
            if ($stmt = $con->prepare('INSERT INTO login (username, password) VALUES (?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ss', $_POST['username'], $password);
                $stmt->execute();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $_POST['username'];
                header('Location: AccueilProfils.php');
            } else {
                $_SESSION['error'] = 4; //erreur SQL
                header('Location: Inscription.php');
                exit();
            }
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = 4; //erreur SQL
        header('Location: Inscription.php');
        exit();
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Inscription</title>
    <style>
    .master{
    display: flex;
    justify-content: space-evenly;
    height: 100%;
}
.login-container {
    display: flex;
    flex-direction: column;
    padding: 1vw;
    text-align: center;
    border-radius: 5px;
    margin-top: 15vh;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    background-color: white;
}
.register-container {
    display: flex;
    flex-direction: column;
    padding: 1vw;
    text-align: center;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    background-color: white;
}
.suppr-container {
    display: flex;
    flex-direction: column;
    padding: 1vw;
    text-align: center;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    background-color: white;
}
.step {
    display: none;
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ddd; 
    margin-bottom: 20px;
    transition: transform 0.5s ease-in-out;
    transform: translateX(100%);
}
.step.active {
    display: block;
    transform: translateX(0);
}
.invalid {
    border: 1px solid red !important;
}
select{
	width: 20vw;
}
h2{
    margin-bottom: 3vh;
}
@media (max-width: 890px) {
	.master{
        flex-direction: column;
        align-items: center;
    }
    .register-container {
        width: 70vw;
        margin-bottom: 3vh;
    }
    .suppr-container {
        width: 70vw;
    }
}</style>
    <!--<link rel="stylesheet" href="../../CSS/Client/LoginContainer.css">-->
    <!--<link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">-->
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <!--<script src="../../JS/Client/Inscription.js"></script>-->
    <script>
    $(document).ready(function() {
        var currentStep = 1;
        var data = {};
        $(".next").click(function() {
            var isValidStep = false;
            switch (currentStep) {
                case 1:
                    data.username = $("#username").val();
                    isValidStep = validateStep1(data);
                    break;
                case 2:
                    data.email = $("#email").val();
                    data.tel = $("#tel").val();
                    data.password = $("#password").val();
                    data.passwordConfirmation = $("#passwordConfirmation").val();
                    isValidStep = validateStep2(data);
                    break;
                case 3:
                    data.prenom = $("#prenom").val();
                    data.nom = $("#nom").val();
                    data.sexe = $("#sexe").val();
                    isValidStep = true;
                    break;
            }
            if (isValidStep) {
                $("#step" + currentStep).removeClass("active");
                currentStep++;
                $("#step" + currentStep).addClass("active");
            } else {
                alert("Please fill in the required fields.");
            }
        });
        $(".prev").click(function() {
            $("#step" + currentStep).removeClass("active");
            currentStep--;
            $("#step" + currentStep).addClass("active");
        });
        function validateStep1(data) {
            var username = data.username;
            if (username == "" || !/^[A-Za-z0-9]+$/.test(username) || username.length > 30 || $("#username").hasClass("invalid")) {
                return false;
            }
            return true;
        }
        function validateStep2(data) {
            var email = data.email;
            var tel = data.tel;
            var password = data.password;
            var passwordConfirmation = data.passwordConfirmation;
            if (email == "" || !/[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/.test(email) || email.length > 50) {
                return false;
            }
            if (!(tel == "") && !/^[0-9]{10}$/.test(tel)) {
                return false;
            }
            if (password == "" || password.length < 8 || password.length > 40) {
                return false;
            }
            if (password != passwordConfirmation) {
                return false;
            }
            return true;
        }
        $("#username").blur(function() {
            var input=$(this);
            var re = /^[A-Za-z0-9]+$/;
            var is_alphanumeric=re.test(input.val());
            var username = $(this).val();
            $.ajax({
                type: "POST",
                url: "./BackEnd/VerifUsername.php",
                data: {username: username},
                success: function(response) {
                    $(".error").remove();
                    if (response == "exists" || !is_alphanumeric) {
                        $("#username").removeClass("valid").addClass("invalid");
                        if(response == "exists"){
                            $("#username").after("<span class='error'>Le pseudo est déja pris</span>");
                        } else {
                            $("#username").after("<span class='error'>Le pseudo ne doit contenir que des lettres et chiffres</span>");
                        }
                    } else {
                        $("#username").removeClass("invalid").addClass("valid");
                    }
                }
            });
        });
        $("#email").blur(function() {
            var input=$(this);
            var re = /[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/;
            var is_email=re.test(input.val());
            $("#email").next(".error").remove();
            if(is_email){
                $("#email").removeClass("invalid").addClass("valid");
            } else {
                $("#email").removeClass("valid").addClass("invalid");
                $("#email").after("<span class='error'>Adresse email invalide</span>");
            }
        });
        $("#password").blur(function() {
            var input=$(this);
            var password=input.val();
            $("#password").next(".error").remove();
            if(password.length < 8 || password.length > 40){
                $("#password").removeClass("valid").addClass("invalid");
                $("#password").after("<span class='error'>Le mot de passe doit contenir entre 8 et 40 caractères</span>");
            } else {
                $("#password").removeClass("invalid").addClass("valid");
            }
        });
        $("#passwordConfirmation").blur(function() {
            var input=$(this);
            var password=input.val();
            var passwordConfirmation=$("#password").val();
            $("#passwordConfirmation").next(".error").remove();
            if(password != passwordConfirmation){
                $("#passwordConfirmation").removeClass("valid").addClass("invalid");
                $("#passwordConfirmation").after("<span class='error'>Les mots de passe ne correspondent pas</span>");
            } else {
                $("#passwordConfirmation").removeClass("invalid").addClass("valid");
            }
        });
        $("#send").click(function() {
            $.ajax({
                type: "POST",
                url: "Inscription.php",
                data: data,
                success: function(response) {
                    // Handle the response...
                }
            });
        });
    });
    function loadFile(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('profilePic');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            // Créer un FormData pour stocker l'image
            var formData = new FormData();
            formData.append('profileImage', event.target.files[0]);
            // Envoyer une requête AJAX au fichier ProfileImageUpload.php
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './BackEnd/ProfileImageUpload.php', true);
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <div class="register-container">
        <div class="step active" id="step1">
            <img id="profilePic" src="path/to/default/profile/pic.jpg" onclick="document.getElementById('profileImage').click();" style="cursor: pointer;">
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
            <a href="Connexion.php">Déjà inscrit ? <b>Connectez-vous!</b></a>>
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
            <button class="send">S'inscrire</button>
        </div>
    </div>
</body>
</html>