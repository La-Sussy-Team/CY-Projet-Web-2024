<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['isAdmin']);
unset($_SESSION['isSub']);
session_destroy();
header('Location: ../../Accueil.php');
exit;
?>