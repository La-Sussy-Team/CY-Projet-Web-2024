<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Connexion.php');
    exit;
}
if (isset($_SESSION['isBanned']) && $_SESSION['isBanned'] != 0) {
    header('Location: ../Client/Banni.php');
    exit;
}
if (isset($_SESSION['questionnaire']) && $_SESSION['questionnaire'] == 0) {
    header('Location: ../Client/Questionnaire.php');
    exit;
}
?>