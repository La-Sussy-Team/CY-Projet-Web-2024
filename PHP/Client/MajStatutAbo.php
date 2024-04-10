<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
$username = $_SESSION['username'];
if($stmt = $con->prepare('UPDATE login SET isSub = 1 WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->close();
} else {
    echo "Erreur de préparation de la requête : " . $con->error;
    exit;
}
if ($stmt = $con->prepare('SELECT isAdmin, isSub FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($isAdmin, $isSub);
        $stmt->fetch();
        $stmt->close();
    session_regenerate_id();
    $_SESSION['username'] = $username;
    $_SESSION['isAdmin'] = $isAdmin;
    $_SESSION['isSub'] = $isSub;
    } else {
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }
}
?>