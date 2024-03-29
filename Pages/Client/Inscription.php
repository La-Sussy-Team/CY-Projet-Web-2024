<?php
session_start();
if (!(!isset($_POST['username'], $_POST['password'], $_POST['confirm_password']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm_password']))){
    $DATABASE_HOST = '127.0.0.1';
    $DATABASE_USER = 'testid';
    $DATABASE_PASS = 'testmdp';
    $DATABASE_NAME = 'personalytree';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if ($_POST['password'] !== $_POST['confirm_password']) {
        exit('Passwords do not match');
    }
    if ($stmt = $con->prepare('SELECT id, password FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'Username exists, please choose another!';
        } else {
            if ($stmt = $con->prepare('INSERT INTO login (username, password) VALUES (?, ?)')) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ss', $_POST['username'], $password);
                $stmt->execute();
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $_POST['username'];
                header('Location: AccueilProfils.php');
            } else {
                echo 'Could not prepare statement!';
            }
        }
        $stmt->close();
    } else {
        echo 'Could not prepare statement!';
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonaliTree - Page d'inscription</title>
    <link rel="stylesheet" href="../../CSS/Inscription.css" type="text/css" media="all">
</head>
<body>
    <header>
        <h1>PersonaliTree</h1>
        <p>Inscription</p>
    </header>
    <form method="POST" action="Inscription.php">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
        <input type="submit" value="S'inscrire">
    </form>
    <a href="Connexion.php">Déjà inscrit? Connectez-vous!</a>
</body>
</html>