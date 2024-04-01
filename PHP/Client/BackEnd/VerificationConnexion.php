<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Connexion.php');
    exit;
}
?>