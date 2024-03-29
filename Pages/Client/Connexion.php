<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: AccueilProfils.php');
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $DATABASE_HOST = '127.0.0.1';
        $DATABASE_USER = 'testid';
        $DATABASE_PASS = 'testmdp';
        $DATABASE_NAME = 'personalytree';
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if ( mysqli_connect_errno() ) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        if ($stmt = $con->prepare('SELECT id, password FROM login WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                if (password_verify($_POST['password'], $password)) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: AccueilProfils.php');
                } else {
                    $_SESSION['error'] = 2; //erreur mauvais mot de passe
                    header('Location: Connexion.php');
                }
            } else {
                $_SESSION['error'] = 1; //erreur pas de compte
                header('Location: Connexion.php');
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonaliTree - Page de connexion</title>
    <link rel="stylesheet" href="../../CSS/Connexion.css" type="text/css" media="all">
</head>
<body>
    <header>
        <h1>PersonaliTree</h1>
        <p>Connexion</p>
    </header>
    <form method="POST" action="Connexion.php">
        <label for="username">Name:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password"><br>
        <input type="submit" value="Connexion">
    </form>
    <a href="Inscription.php">Pas de compte? Inscrivez-vous!</a>
</body>
</html>