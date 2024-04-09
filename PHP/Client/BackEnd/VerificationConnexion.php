<?php
session_start();
if (!isset($_SESSION['username'])) {
    if (isset($_SESSION['isBanned']) && $_SESSION['isBanned'] == 1) {
        header('Location: ../Client/BackEnd/Banni.php');
        exit;
    } else {
        header('Location: Connexion.php');
        exit;
    }
}
?>