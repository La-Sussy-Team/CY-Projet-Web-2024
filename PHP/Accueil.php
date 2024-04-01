<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Client/LoginContainer.css">
    <link rel="stylesheet" href="../CSS/Client/StylesCommuns.css">
    <script defer src="../JS/Client/Login_Box.js"></script>
    <title>PersonaliTree - Rencontre par affinité naturelle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f3;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        p {
            line-height: 1.6;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .login_page{
            position:fixed;
            border: 4px solid #333;
            border-radius: 10px;
            z-index: 10;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%) scale(0);
            background-color: white;
        }
        .login_page.active{
            transform: translate(-50%, -50%) scale(1);
        }
        #overlay{
            position: fixed;
            opacity: 0;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            pointer-events: none;
        }
        #overlay.active{
            opacity: 1;
            pointer-events: all;
        }
    </style>
</head>
<?php
include "./Client/Header.php";
?>
<body>
    <header>
        <h1>PersonaliTree</h1>
        <p>Rencontrez des personnes partageant votre affinité naturelle à travers une plante ou un arbre.</p>
        <button data-connexion-target="#login_page">Connexion</button>
    </header>
    <div class="container">
        <h2>Bienvenue sur PersonaliTree</h2>
        <p>PersonaliTree vous permet de rencontrer des personnes qui partagent votre amour pour la nature. Que vous soyez passionné par les arbres majestueux, les fleurs colorées ou les plantes exotiques, notre plateforme vous mettra en contact avec des personnes partageant vos intérêts.</p>
        <p>Pour accéder aux profils et commencer à faire des rencontres, veuillez vous connecter ou vous inscrire.</p>
        <p>Rejoignez-nous dès maintenant et laissez la nature vous guider vers de nouvelles relations enrichissantes !</p>
    </div>
    <div class="login_page" id="login_page">
        <div class="login-container">
            <h2>Connexion</h2> <button data-close-button class="close">&times;</button>
            <form method="POST" action="Client/Connexion.php">
                <label for="username"><h3>Nom d'utilisateur :</h3> </label>
                <input type="text" id="username" name="username" required autocomplete="username"><br>
                <label for="password"><h3>Mot de passe :</h3></label>
                <input type="password" id="password" name="password" required autocomplete="current-password"><br>
                <input type="submit" value="Connexion">
            </form>
            <a href="Inscription.php">Pas encore inscrit ? <b>Inscrivez-vous gratuitement !</b></a>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
    <footer>
        <p>&copy; 2024 PersonaliTree. Tous droits réservés.</p>
    </footer>
</body>
</html>