<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';

// Récupérer les conversations de l'utilisateur à afficher à droite
$user_id = $_SESSION['id'];
$sql = 'SELECT * FROM conversation WHERE user1_id = ? OR user2_id = ?';
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param('ii', $user_id, $user_id);
    $stmt->execute();
    $user_conversations_result = $stmt->get_result();
    $stmt->close();

    // Vérifier s'il y a des conversations à afficher
    if ($user_conversations_result && $user_conversations_result->num_rows > 0) {
        $user_conversations = $user_conversations_result->fetch_all(MYSQLI_ASSOC);
    } else {
        // Aucune conversation à afficher
        $user_conversations = array();
    }
} else {
    // Gérer l'erreur de préparation de la requête
    echo "Erreur de préparation de la requête : " . $con->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations</title>
</head>
<body>
    <h1>Conversations</h1>
    <div class="conversations">
    <?php if (!empty($user_conversations)) : ?>
        <ul>
            <?php foreach ($user_conversations as $conversation) : ?>
                <?php
                // Déterminer l'autre utilisateur dans la conversation
                $other_user_id = ($conversation['user1_id'] == $user_id) ? $conversation['user2_id'] : $conversation['user1_id'];
                
                // Récupérer le nom de l'autre utilisateur depuis la base de données
                $stmt = $con->prepare('SELECT username FROM login WHERE id = ?');
                if ($stmt) {
                    $stmt->bind_param('i', $other_user_id);
                    $stmt->execute();
                    $stmt->bind_result($other_username);
                    $stmt->fetch();
                    $stmt->close();
                }
                ?>
                <li><a href="get_messages.php?user_id=<?php echo $user_id ?>&other_user_id=<?php echo $other_user_id; ?>"><?php echo htmlspecialchars($other_username); ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucune conversation disponible.</p>
    <?php endif; ?>
</div>

    <div class="nouvelle-conversation">
        <h2>Nouvelle Conversation</h2>
        <form method="POST" action="create_conversation.php">
            <label for="username">Nom de l'utilisateur destinataire :</label><br>
            <input type="text" id="username" name="username" required><br>
            <button type="submit">Créer la conversation</button>
        </form>
    </div>
    <div class="rechercher-utilisateur">
        <h2>Rechercher un Utilisateur</h2>
        <form action="rechercher_utilisateur.php" method="POST">
            <label for="nom_utilisateur">Nom de l'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    <a href="./Deconnexion.php">Se déconnecter</a>

</body>
</html>
