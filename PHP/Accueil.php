<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Client/PageAccueil.css">
    <link rel="stylesheet" href="../CSS/Header.css">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Rencontre par affinité naturelle</title>
</head>
<body>
    <header>
        <a href="./Accueil.php"><img class="logo" src="../Assets/Logo/Logo_Fullscreen.png" alt=""></a>
        <ul class ="inter">
            <li><a class="plusG" href="./Accueil.php">Accueil</a></li>
            <li><a class="plusG" href="#">Découverte de Profils</a></li>
            <li><a class="plusG" href="./Client/RechercheProfils.php">Recherche de Profils</a></li>
            <?php
            echo '<div class="inter">';
            if (isset($_SESSION['username'])) {
                if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                    echo '<li><a class="button" href="./Admin/AccueilAdmin.php"><img class="accAdmin" src="../Assets/Logo/admin.png">Accueil Admin</a><li>';
                }
                echo '<li><a class="button" href="./Client/MonProfil.php"><img class="accAdmin" src="../Assets/Logo/myProfile.png">Mon Profil</a><li>';
                echo '<li><a class="button" href="./Client/BackEnd/Deconnexion.php"><img class="accAdmin" src="../Assets/Logo/logout.png">Déconnexion</a><li>';
            } else {
                echo '<li><a class="button" href="./Client/Inscription.php"><img class="accAdmin" src="../Assets/Logo/register.png">Inscription</a><li>';
                echo '<li><a class="button" href="./Client/Connexion.php"><img class="accAdmin" src="../Assets/Logo/myProfile.png">Connexion</a><li>';
            }
            echo '</div>';
            ?>
        </ul>
    </header>
    <div class="middle1">
        <div class="titredivtop">
            <h2 class="titre-mid">PersonnaliTree : Trouvez l'amour à l'aide des plantes</h2>
        </div>
        <div class="image-grid">
            <div class="image-container">
                <img src="../Assets/PageAcceuil/lamour.png" alt="Trouver l'amour avec votre personnalité">
                <h3>Trouver l'amour en accord avec votre personnalité</h3>
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
        <div class="image-container2">
                <img src="../Assets/PageAcceuil/moderateur.png" alt="Image 4">
                <h3>Modération et Anti-Harcèlement</h3>
                <p>Nous prenons très au sérieux la sécurité de nos utilisateurs. Notre équipe de modération travaille sans relâche pour prévenir et éliminer tout comportement inapproprié ou harcelant. Nous nous engageons à créer un environnement sûr et accueillant pour tous.</p>
            </div>
        </div>
    </div>

    <div class="footer">
            <a class="foot" href="Accueil.php">© 2024 PersonaliTree</a>
            <a class="foot" href="Accueil.php">Conditions générales d'utilisation</a>
            <a class="foot" href="Accueil.php">Régles de  communauté</a>
            <div class="return">
                <a class="foot" href="Accueil.php">▲ Retour en haut ▲</a>
            </div>
        </div>
</body>
</html>
