<?php
include "./BackEnd/VerificationConnexion.php";
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
    <link rel="stylesheet" href="../../CSS/Client/AccueilProfils.css">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Accueil Profils</title>
    <script src="../../JS/Librairies/jquery-3.7.1.min.js">
    </script>
</head>
<?php
    include "Header.php";
?>
<body>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Profil</title>
</head>
<body>
    <div class="container">
        <div class="section">
            <h2>Bienvenue <?php echo($username)?> </h2>
            <div class="section-content">
                <div class="images-container">
                    <div class="imagetop">
                        <img src="../../Assets/Client/accueilprofil/local.png" alt="Image 1">
                        <p class="ptop">Trouver l'amour d'un clic</p>
                    </div>
                    <div class="imagetop">
                        <img src="../../Assets/Client/accueilprofil/reseau.png" alt="Image 2">
                        <p class="ptop">Faites partie des + de 10 000 rencontres</p>
                    </div>
                    <div class="imagetop">
                        <img src="../../Assets/Client/accueilprofil/lamour.png" alt="Image 3">
                        <p class="ptop"> Trouver la personalité parfaite</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="section">
            <h2>Rechercher des célibataires</h2>
            <div class="section-content">
                <div class="container">
                    <div class="section rechercher-celibataire">
                        <div class="overlay"></div> 
                        <form action="RechercheProfils.php" method="POST">
                            <button type="submit">Rechercher</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <h2 class="h2message">Vos discussions</h2>
            <div class="section-content">
                <div class="left-section">
                    <h3 class="h3message"> Envie de discuter ? Alors n'hésitez pas à ajouter des personnes pour converser. </h3>
                    <p class="pmessage">Sur notre site de rencontre, chaque conversation est une chance de découvrir une nouvelle connexion, une nouvelle complicité. Osez engager le dialogue et laissez la magie opérer pour créer des liens authentiques et peut-être même une belle histoire à partager.</p>
                    <form action="conversation.php" method="POST">
                        <button type="submit">Vos discutions</button>
                    </form>
                </div>
                <div class="right-section">
                    <img src="../../Assets/Client/accueilprofil/message.jpg" alt="Image">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
