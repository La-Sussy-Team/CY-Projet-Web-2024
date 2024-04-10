<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if(isset($_POST['message']) && isset($_POST['receiver_id'])){
        $sender_id = null;
        $username = $_SESSION['username'];
        $stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->bind_result($sender_id);
            $stmt->fetch();
            $stmt->close();
        }
        $receiver_id = $_POST['receiver_id'];
        $contenu_message = $_POST['message'];
        $timestamp = date('Y-m-d H:i:s');
        $conversation_id = $_POST['conversation_id'];
        $sql = "INSERT INTO messages (sender_id, receiver_id, conversation_id, message, timestamp) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iiiss", $sender_id, $receiver_id, $conversation_id, $contenu_message,$timestamp);
            if ($stmt->execute()) {
                header('Location: get_messages.php?user_id=' . $sender_id.'&'.'other_user_id='.$receiver_id);
                exit;
            } else {
                echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
                exit;
            }
        } else {
            echo "Erreur de préparation de la requête : " . $con->error;
            exit;
        }
    }
    else {
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }
} else {
    header('Location: erreur.php');
    exit;
}
?>