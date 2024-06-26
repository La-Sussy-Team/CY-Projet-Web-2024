<link rel="stylesheet" type="text/css" href="../../CSS/Header.css">
<header>
    <a href="../Accueil.php"><img class="logo" src="../../Assets/Logo/Logo_Fullscreen.png" alt=""></a>
    <ul class ="inter">
        <?php
        if (isset($_SESSION['username'])) {
            echo '<li><a class="plusG" href="./AccueilProfils.php">Accueil Profils</a></li>';
            echo '<li><a class="plusG" href="./RechercheProfils.php">Recherche de Profils</a></li>';
            echo '<li><a class="plusG" href="./Recommendation.php">Recommendations de Profils</a></li>';
            if (isset($_SESSION['isSub']) && $_SESSION['isSub'] == 1 && isset($_SESSION['isBanned']) && $_SESSION['isBanned'] == 0) {
                echo '<li><a class="plusG" href="./Conversation.php">Messagerie</a></li>';
                echo '<li><a class="plusG" href="./Consultation.php">Consultation</a></li>';
            } else if (isset($_SESSION['isBanned']) && $_SESSION['isBanned'] == 0) {
                echo '<li><a class="plusG" href="./OffreEtAbonnement.php">Abonnement</a></li>';
            }
        } else {
            echo '<li><a class="plusG" href="../Accueil.php">Accueil</a></li>';
        }
        ?>
        <?php
        echo '<div class="inter">';
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                echo '<li><a class="button plusG" href="../Admin/AccueilAdmin.php"><img class="accAdmin" src="../../Assets/Logo/admin.png">Accueil Admin</a><li>';
            }
            echo '<li><a class="button plusG" href="./MonProfil.php"><img class="accAdmin" src="../../Assets/Logo/myProfile.png">Mon Profil</a><li>';
            echo '<li><a class="button plusG" href="./BackEnd/Deconnexion.php"><img class="accAdmin" src="../../Assets/Logo/logout.png">Déconnexion</a><li>';
        } else {
            echo '<li><a class="button plusG" href="./Inscription.php"><img class="accAdmin" src="../../Assets/Logo/register.png">Inscription</a><li>';
            echo '<li><a class="button plusG" href="./Connexion.php"><img class="accAdmin" src="../../Assets/Logo/myProfile.png">Connexion</a><li>';
        }
        echo '</div>';
        ?>
    </ul>
</header>