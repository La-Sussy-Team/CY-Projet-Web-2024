<?php
// Vérification de la session pour s'assurer que l'utilisateur est connecté
include './BackEnd/VerificationConnexion.php';

// Inclusion du fichier de connexion à la base de données
include './BackEnd/LoginDatabase.php';

// Vérification si la requête POST contient la variable d'abonnement
if(isset($_POST['abonnement']) && $_POST['abonnement'] == 'abonne') {
    // Récupération de l'ID de l'utilisateur actuellement connecté
    $userId = $_SESSION['user_id'];

    // Préparation de la requête SQL pour mettre à jour le statut d'abonnement dans la table "login"
    $sql = "UPDATE `login` SET `isSub` = 1 WHERE `id` = $userId";

    // Exécution de la requête SQL
    if(mysqli_query($conn, $sql)) {
        // Envoi d'une réponse JSON en cas de succès
        echo json_encode(array("success" => true));
    } else {
        // Envoi d'une réponse JSON en cas d'échec
        echo json_encode(array("success" => false, "error" => mysqli_error($conn)));
    }
} else {
    // Envoi d'une réponse JSON en cas de requête incorrecte
    echo json_encode(array("success" => false, "error" => "Invalid request"));
}
?>
