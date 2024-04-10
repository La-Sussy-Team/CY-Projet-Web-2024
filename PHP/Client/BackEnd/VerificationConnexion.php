<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Connexion.php');
    exit;
}
if (isset($_SESSION['isBanned']) && $_SESSION['isBanned'] == 1) {
    header('Location: ../Client/BackEnd/Banni.php');
    exit;
}
?>