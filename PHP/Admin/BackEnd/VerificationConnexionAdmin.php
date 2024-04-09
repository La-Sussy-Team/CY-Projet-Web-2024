<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1){
    header('Location: ../Client/Connexion.php');
    exit;
}
?>