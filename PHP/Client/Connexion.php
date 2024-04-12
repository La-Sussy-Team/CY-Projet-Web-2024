<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: AccueilProfils.php');
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        include 'BackEnd/LoginDatabase.php';
        if ($stmt = $con->prepare('SELECT id, password, isAdmin, isSub, isBanned FROM login WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password, $isAdmin, $isSub, $isBanned);
                $stmt->fetch();
                if (password_verify($_POST['password'], $password)) {
                    session_regenerate_id();
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['isAdmin'] = $isAdmin;
                    $_SESSION['isSub'] = $isSub;
                    $_SESSION['isBanned'] = $isBanned;
                    if ($stmt = $con->prepare('SELECT * FROM relationplante WHERE id = ?')) {
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $stmt->store_result();
                        if ($stmt->num_rows > 0) {
                            $_SESSION['questionnaire'] = 1;
                            } else {
                            $_SESSION['questionnaire'] = 0;
                        }
                    } else {
                        $_SESSION['error'] = 1;
                        header('Location: Connexion.php');
                        exit();
                    }
                    header('Location: AccueilProfils.php');
                    exit();
                } else {
                    $_SESSION['error'] = 1;
                    header('Location: Connexion.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 1;
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
    <title>PersonalyTree - Connexion</title>
    <link rel="stylesheet" href="../../CSS/Client/LoginContainer.css">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
</head>
<?php
include "Header.php";
?>
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
            <div class="inscr">
                <a href="Inscription.php">Pas encore inscrit ? <b>Inscrivez-vous gratuitement !</b></a>
            </div>
        </div>
    </div>
</body>
</html>
