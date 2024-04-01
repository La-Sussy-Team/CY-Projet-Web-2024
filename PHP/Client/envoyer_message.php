<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if(isset($_POST['message']) && isset($_POST['receiver_id'])){
    
        // Récupérer l'ID de l'utilisateur connecté
        $sender_id = $_SESSION['id'];

        // Récupérer l'ID du destinataire du message
        $receiver_id = $_POST['receiver_id'];

        // Récupérer le contenu du message
        $contenu_message = $_POST['message'];

        $timestamp = date('Y-m-d H:i:s');

        $conversation_id = $_POST['conversation_id'];

        // Préparer la requête SQL

        // Insérer le message dans la base de données
        $sql = "INSERT INTO messages (sender_id, receiver_id, conversation_id, message, timestamp) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iiiss", $sender_id, $receiver_id, $conversation_id, $contenu_message,$timestamp);
            if ($stmt->execute()) {
                // Rediriger l'utilisateur vers la page de la conversation
                header('Location: get_messages.php?user_id=' . $sender_id.'&'.'other_user_id='.$receiver_id);
                exit;
            } else {
                // Gérer l'erreur d'exécution de la requête
                echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
                exit;
            }
        } else {
            // Gérer l'erreur de préparation de la requête
            echo "Erreur de préparation de la requête : " . $con->error;
            exit;
        }
    }
    else {
        // Gérer l'erreur de préparation de la requête
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }

} else {
    // Rediriger l'utilisateur vers une page d'erreur si le formulaire n'a pas été soumis correctement
    header('Location: erreur.php');
    exit;
}
?>

