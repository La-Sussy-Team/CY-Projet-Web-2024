<?php
session_start();
if (!(!isset($_POST['username'], $_POST['password'], $_POST['passwordConfirmation']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordConfirmation']))){
    if (!preg_match("/^[A-Za-z0-9]+$/", $_POST['username'])) {
        $_SESSION['error'] = 1; //erreur caractères spéciaux
        header('Location: Inscription.php');
        exit();
    }
    $DATABASE_HOST = '127.0.0.1';
    $DATABASE_USER = 'testid';
    $DATABASE_PASS = 'testmdp';
    $DATABASE_NAME = 'personalytree';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    //if ( mysqli_connect_errno() ) {
    //    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    //}
    if ($_POST['password'] !== $_POST['passwordConfirmation']) {
        $_SESSION['error'] = 3; //erreur mots de passe différents
            header('Location: Inscription.php');
            exit();
    }
    if ($stmt = $con->prepare('SELECT id, password FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error'] = 2; //erreur nom d'utilisateur déjà utilisé
            header('Location: Inscription.php');
            exit();
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
                $_SESSION['error'] = 4; //erreur SQL
                header('Location: Inscription.php');
                exit();
            }
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = 4; //erreur SQL
        header('Location: Inscription.php');
        exit();
    }
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Inscription</title>
    <link rel="stylesheet" href="../../CSS/Client/LoginContainer.css">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
    <script src="../../JS/Librairies/code.jquery.com_jquery-3.6.0.min.js"></script>
    <script src="../../JS/Inscription.js"></script>
</head>
<body>
    <div class="master">
        <div class="register-container">
            <h2>Inscription</h2>
            <form method="POST" action="Inscription.php">
                <label for="username"><h3>Nom d'utilisateur :</h3></label>
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required autocomplete="username" pattern="[A-Za-z0-9]+">
                <label for="password"><h3>Mot de passe :</h3></label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
                <label for="passwordConfirmation"><h3>Confirmer le mot de passe :</h3></label>
                <input type="password" name="passwordConfirmation" id="passwordConfirmation" required autocomplete="current-password">
                <?php 
                if (isset($_SESSION['error'])){
                        if ($_SESSION['error'] == 1) {
                            echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Le nom d'utilisateur ne doit contenir que des lettres et chiffres</p>";
                        } else if ($_SESSION['error'] == 2){
                            echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Nom d'utilisateur déjà utilisé</p>";
                        } else if ($_SESSION['error'] == 3){
                            echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Les mots de passe ne correspondent pas</p>";
                        } else if ($_SESSION['error'] == 4){
                            echo "<p style='color: red; font-size: 1.2vw; display: flex; justify-content: center; margin-bottom: 1vh; text-align: center;'>Erreur SQL</p>"; //debug
                        }
                    unset($_SESSION['error']);
                }
                ?>
                <input type="submit" value="S'inscrire">
            </form>
            <a href="Connexion.php">Déjà inscrit ? <b>Connectez-vous!</b></a>
        </div>
    </div>
</body>
</html>