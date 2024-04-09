<link rel="stylesheet" type="text/css" href="../../CSS/Header.css">
<header>
    <a href="../Accueil.php"><img class="logo" src="../../Assets/Logo/Logo_Fullscreen.png" alt=""></a>
    <ul class ="inter">
        <li><a href="../Accueil.php">Accueil</a></li>
        <li><a href="#">Découverte de Profils</a></li>
        <li><a href="./RechercheProfils.php">Recherche de Profils</a></li>
        <?php
        echo '<div class="inter">';
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                echo '<li><a class="button" href="../Admin/AccueilAdmin.php"><img class="accAdmin" src="../../Assets/Logo/admin.png">Accueil Admin</a><li>';
            }
            echo '<li><a class="button" href="./MonProfil.php"><img class="accAdmin" src="../../Assets/Logo/myProfile.png">Mon Profil</a><li>';
            echo '<li><a class="button" href="./BackEnd/Deconnexion.php"><img class="accAdmin" src="../../Assets/Logo/logout.png">Déconnexion</a><li>';
        } else {
            echo '<li><a class="button" href="./Inscription.php"><img class="accAdmin" src="../../Assets/Logo/register.png">Inscription</a><li>';
            echo '<li><a class="button" href="./Connexion.php"><img class="accAdmin" src="../../Assets/Logo/myProfile.png">Connexion</a><li>';
        }
        echo '</div>';
        ?>
    </ul>
</header>