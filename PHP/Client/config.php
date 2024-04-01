<?php
// Informations de connexion à la base de données
$DATABASE_HOST = '127.0.0.1'; // Adresse du serveur MySQL
$DATABASE_USER = 'root'; // Nom d'utilisateur MySQL
$DATABASE_PASS = 'root'; // Mot de passe MySQL
$DATABASE_NAME = 'chat'; // Nom de la base de données

// Connexion à la base de données
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Vérifier la connexion
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
