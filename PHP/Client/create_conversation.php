<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $username2 = $_POST['username2'];
        $user1_id = null;
        $stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username2);
            $stmt->execute();
            $stmt->bind_result($user1_id);
            $stmt->fetch();
            $stmt->close();
        }
        $stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user2_id);
                $stmt->fetch();
                $stmt->close();
                $sql = 'SELECT id FROM conversation WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)';
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('iiii', $user1_id, $user2_id, $user2_id, $user1_id);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        header('Location: conversation.php');
                        $stmt->close();
                        exit;
                    }
                }
                $sql = 'INSERT INTO conversation (user1_id, user2_id) VALUES (?, ?)';
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('ii', $user1_id, $user2_id);
                    $stmt->execute();
                    $stmt->close();
                    header('Location: conversation.php');
                    exit;
                } else {
                    echo "Erreur de préparation de la requête : " . $con->error;
                    header('Location: erreur.php');
                    exit;
                }
            } else {
                echo "L'utilisateur destinataire n'existe pas.";
            }
        } else {
            echo "Erreur de préparation de la requête : " . $con->error;
            header('Location: erreur.php');
            exit;
        }
    } else {
        echo "Le nom de l'utilisateur destinataire est requis.";
    }
} else {
    echo "Le formulaire doit être soumis via POST.";
}

?>
