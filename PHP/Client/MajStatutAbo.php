<?php
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "chat";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la donnée d'abonnement est reçue
    if (isset($_POST['abonnement'])) {
        // Récupérer la valeur de l'abonnement
        $nouvel_abonnement = $_POST['abonnement'];

        // Mettre à jour le statut d'abonnement de l'utilisateur dans la base de données
        $sql = "UPDATE login SET statut_abonnement = '$nouvel_abonnement' WHERE id = <ID_UTILISATEUR>";
        
        if ($conn->query($sql) === TRUE) {
            echo "Statut d'abonnement mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du statut d'abonnement : " . $conn->error;
        }
    } else {
        echo "Données d'abonnement non reçues.";
    }
} else {
    echo "Cette page ne peut être accédée directement.";
}

// Fermer la connexion
$conn->close();
?>

