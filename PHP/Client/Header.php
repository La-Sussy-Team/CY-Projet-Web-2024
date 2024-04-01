<link rel="stylesheet" type="text/css" href="../../CSS/Client/Menu_Site.css">
<div class="bar">
    <div class="bar_1">
        <img class="logo1" src="../../Assets/Logo/Logo_Fullscreen.png">
    </div>
    <div class="bar_2">
        <ul class="navbar">
            <li><a href="../Accueil.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Accueil</a></li>
            <li><a href="./RechercheProfils.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Recherche de profils</a></li>
            <li><a href="../../PHP/Client-Pages/Carte.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Carte des contacts</a></li>
        </ul>
    </div>
    <div class="bar_3">
        <?php
        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
                echo '<a href="./../Admin/AccueilAdmin.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Gestion Administrateur<img class="logo65" src="../../Assets/Logo/4192781.png"></a>';
            }
            echo '<a href="./MonProfil.php" style="color: white; text-decoration: none; display: flex;  margin-left: 15px; align-items: center;">Mon Profil<img class="logo65" src="../../Assets/Logo/login.png"></a>';
            echo '<a href="./BackEnd/Deconnexion.php" style="color: white; text-decoration: none; display: flex; margin-left: 15px; align-items: center;">Déconnexion<img class="logo65" src="../../Assets/Logo/logout.jpg"></a>';
        } else {
            echo '<a href="./Inscription.php" style="color: white; text-decoration: none; display: flex; align-items: center;">Inscription<img class="logo65" src="../../Assets/Logo/register.jpg"></a>';
            echo '<a href="./Connexion.php" style="color: white; text-decoration: none; display: flex; margin-left: 15px; align-items: center;">Connexion<img class="logo65" src="../../Assets/Logo/logout.jpg"></a>';
        }
        ?>
    </div>
</div>