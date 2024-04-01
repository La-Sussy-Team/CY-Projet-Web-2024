<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Client/LoginContainer.css">
    <link rel="stylesheet" href="../CSS/Client/PageAccueil.css">
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
<link rel="stylesheet" type="text/css" href="../../CSS/Client/Menu_Site.css">
<div class="bar">
    <div class="bar_1">
        <img class="logo1" src="../../Assets/Logo/Logo_Fullscreen.png">
    </div>
    <div class="bar_2">
        <ul class="navbar">
            <li><a href="./Accueil.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Accueil</a></li>
            <li><a href="./Client/RechercheProfils.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Recherche de profils</a></li>
            <li><a href="../../PHP/Client-Pages/Carte.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Carte des contacts</a></li>
        </ul>
    </div>
    <div class="bar_3">
        <?php
        if (isset($_SESSION['id'])) {
            echo '<a href="./Client/MonProfil.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Mon Profil<img class="logo65" src="../../Assets/Logo/login.png"></a>';
            echo '<a href="./Client/BackEnd/Deconnexion.php" style="color: white; text-decoration: none; display: flex; margin-left: 15px; align-items: center;">Déconnexion<img class="logo65" src="../../Assets/Logo/logout.jpg"></a>';
        } else {
            echo '<a href="./Client/Inscription.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Inscription<img class="logo65" src="../../Assets/Logo/register.jpg"></a>';
            echo '<a href="./Client/Connexion.php" style="color: white; text-decoration: none; display: flex; margin-left: 15px; align-items: center;">Connexion<img class="logo65" src="../../Assets/Logo/logout.jpg"></a>';
        }
        ?>
    </div>
</div>
<body>
    <div class="bar">
            <div class="bar_1">
                <a href="PageAcceuil.html"><img class="logo1" src="../Assets/Logo/Logo.jpg" alt=""></a>
                <h1 class="ff">PersonnalyTree</h1>
            </div>
            <div class="bar_2">
                <ul class="navbar">
                    <a class="button_ab" href="">S'abonner</a>
                </ul>
            </div>
            <div class="bar_3">
                <a class="button" href="PageAcceuil.html">Connexion</a>
                <a class="button" href="PageAcceuil.html">Inscription</a>
            </div>
        </div>
        
        <div class="middle1">
            <img class="img1" src="../Assets/PageAcceuil/img1.png" alt="">
            <div class="titredivmid">
                <h2 class="titre-mid">PersonnaliTree : trouvez l'amour sur votre personnalité</h2>
                <h2 class="titre-mid"> à l'aide des plantes</h2>
            </div>
            <div class="image-grid">
                <div class="image-container">
                    <img src="../Assets/PageAcceuil/lamour.png" alt="Trouver l'amour avec votre personnalité">
                    <h3>Trouver l'amour avec votre personnalité</h3>
                </div>
                <div class="image-container">
                    <img src="../Assets/PageAcceuil/local.png" alt="Trouver l'amour près de chez vous">
                    <h3>Trouver l'amour près de chez vous</h3>
                </div>
            </div>
            <div class="dessousfleur">
                <div class="image-grid">
                    <div class="image-container">
                        <img src="../Assets/PageAcceuil/iris.png" alt="Image 1">
                        <h3>Personnalité Aventureuse</h3>
                        <p>Rencontrez des personnes qui aiment l'aventure et trouvez la plante qui vous accompagnera dans vos explorations.</p>
                    </div>
                    <div class="image-container">
                        <img src="../Assets/PageAcceuil/hibiscus.png" alt="Image 2">
                        <h3>Personnalité Créative</h3>
                        <p>Rencontrez des personnes créatives et trouvez la plante qui inspirera votre imagination.</p>
                    </div>
                    <div class="image-container">
                        <img src="../Assets/PageAcceuil/passiflore.png" alt="Image 3">
                        <h3>Personnalité Calme</h3>
                        <p>Rencontrez des personnes calmes et trouvez la plante qui apportera sérénité dans votre vie.</p>
                    </div>
                </div>
            </div>
            <div class="moderation-section">
                <div class="text-container">
                    <h3 class="titremod">Modération et Anti-Harcèlement</h3>
                    <p class="textemod">Nous prenons très au sérieux la sécurité de nos utilisateurs. Notre équipe de modération travaille sans relâche pour prévenir et éliminer tout comportement inapproprié ou harcelant. Nous nous engageons à créer un environnement sûr et accueillant pour tous.</p>
                </div>
                <div class="image-container2">
                    <img src="../Assets/PageAcceuil/moderation.png" alt="Modération et Anti-Harcèlement">
                </div>
            </div>
        </div>
</body>
</html>