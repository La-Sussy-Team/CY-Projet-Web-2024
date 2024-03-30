<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: AccueilProfils.php');
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        include 'BackEnd/LoginDatabase.php';
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
                    exit();
                } else {
                    $_SESSION['error'] = 1; //erreur mauvais mot de passe
                    header('Location: Connexion.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 1; //erreur pas de compte
                header('Location: Connexion.php');
                exit();
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
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Connexion</title>
    <link rel="stylesheet" href="../../CSS/Client/LoginContainer.css">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
</head>
<body>
    <div class="master">
        <div class="login-container">
            <h2>Connexion</h2>
            <form method="POST" action="Connexion.php">
                <label for="username"><h3>Nom d'utilisateur :</h3></label>
                <input type="text" id="username" name="username" required autocomplete="username"><br>
                <label for="password"><h3>Mot de passe :</h3></label>
                <input type="password" id="password" name="password" required autocomplete="current-password"><br>
                <?php 
                if (isset($_SESSION['error'])){
                    echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Nom d'utilisateur ou mot de passe incorrect</p>";
                    unset($_SESSION['error']);
                }
                ?>
                <input type="submit" value="Connexion">
            </form>
            <a href="Inscription.php">Pas encore inscrit ? <b>Inscrivez-vous gratuitement !</b></a>
        </div>
    </div>
</body>
</html>