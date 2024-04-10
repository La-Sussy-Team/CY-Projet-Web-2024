<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';

// Vérifier si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ username est défini dans le formulaire
    if (isset($_POST['username'])) {
        // Récupérer le nom de l'utilisateur destinataire depuis le formulaire
        $username = $_POST['username'];
        $username2 = $_POST['username2'];
        // Inclure le fichier de configuration de la base de données
        include 'config.php';

        // Récupérer l'identifiant de l'utilisateur connecté
        $user1_id = null;


        // Requête SQL pour récupérer l'ID de l'utilisateur en fonction du nom d'utilisateur
        $stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username2);
            $stmt->execute();
            $stmt->bind_result($user1_id);
            $stmt->fetch();
            $stmt->close();
        }

        // Rechercher l'identifiant de l'utilisateur destinataire dans la table login
        $stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($user2_id);
                $stmt->fetch();
                $stmt->close();

                // Insérer la nouvelle conversation dans la table conversations
                $sql = 'INSERT INTO conversation (user1_id, user2_id) VALUES (?, ?)';
                $stmt = $con->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('ii', $user1_id, $user2_id);
                    $stmt->execute();
                    $stmt->close();

                    // Rediriger vers la page des conversations après la création de la conversation
                    header('Location: conversation.php');
                    exit;
                } else {
                    // Gérer l'erreur de préparation de la requête
                    echo "Erreur de préparation de la requête : " . $con->error;
                    // Ou rediriger vers une page d'erreur
                    header('Location: erreur.php');
                    exit;
                }
            } else {
                // L'utilisateur destinataire n'existe pas
                echo "L'utilisateur destinataire n'existe pas.";
            }
        } else {
            // Gérer l'erreur de préparation de la requête
            echo "Erreur de préparation de la requête : " . $con->error;
            // Ou rediriger vers une page d'erreur
            header('Location: erreur.php');
            exit;
        }
    } else {
        // Si le champ username n'est pas défini dans le formulaire
        echo "Le nom de l'utilisateur destinataire est requis.";
    }
} else {
    // Si le formulaire n'a pas été soumis via POST
    echo "Le formulaire doit être soumis via POST.";
}
?>
