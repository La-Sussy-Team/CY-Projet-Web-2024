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
    <title>PersonaliTree - Accueil Profils</title>
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
    <style>

        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 10vw;
        }
        
        .section h2 {
            margin-top: 2%;
            text-align: center;
            font-size: 4vw;
            
        }
        
        /* Style spécifique pour la section "Rechercher des célibataires" */
        .rechercher-celibataire {
            position: relative;
            height: 750px; /* Hauteur de la section */
            background-image: url('../../Assets/Client/accueilprofil/celibcherche.jpg'); /* Chemin vers votre image */
            background-size: cover; /* Redimensionne l'image pour couvrir la section */
            background-position: center; /* Centre l'image dans la section */
            
        }
        .rechercher-celibataire .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.3); /* Couleur de fond semi-transparente */
        }

        .rechercher-celibataire img{
            filter: blur(2px);
        }

        .rechercher-celibataire button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .left-section button {
            margin-left: 35%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .section {
            position: relative;
        }

        .images-container {
            display: flex;
            justify-content: center;
        }

        .imagetop {
            text-align: center;
            margin: 5% 5%; 
        }

        .imagetop img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        .imagetop p {
            margin-top: 10px;
        }

        .ptop{
            font-size: 1.3vw;
        }

        .left-section {
            float: left;
            width: 50%;
        }

        .right-section {
            float: right;
            width: 50%;
        }
        
        .right-section img {
            width: 70%;
        }

        .h3message {
            font-size: 2vw;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 35%;
        }

        .pmessage {
            margin-top: 10px;
            font-size: 1.3vw;
            margin-bottom: 10px;
            margin-left: 35%;
        }

        .left-section button {
            display: block;
            margin-top: 10px;
        }

        .h2message {
            text-align: center;
            font-size: 4vw;
            margin-bottom: 2%;
        }

        .recommendation {
            margin-top: 50px !important;
        }


    </style>
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

        <!-- Div "Recommandation de profil" -->
    
    </div>
    <div class="recommendation">   
            
        <h2>Recommandation de profil</h2>
        <div class="section-content">
            <!-- Contenu de la section "Recommandation de profil" -->
            
        </div>
        
    </div> 
</body>
</html>
