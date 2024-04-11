<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
if (!isset($_GET['other_user_id'])) {
    header('Location: conversation.php');
    exit;
}
$other_user_id = $_GET['other_user_id'];
$user_id = null;
$username = $_SESSION['username'];
$stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
if ($stmt) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
}
$sql = "SELECT id FROM conversation WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?) LIMIT 1";
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param("iiii", $user_id, $other_user_id, $other_user_id, $user_ids);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $conversation_id = $row['id'];
    }
}
$stmt = $con->prepare('SELECT username FROM login WHERE id = ?');
if ($stmt) {
    $stmt->bind_param('i', $other_user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
}
function ouvrirServeurMessages($con, $user_id, $other_user_id) {
    $sql = 'INSERT INTO serveurs_messages (user_id, other_user_id) VALUES (?, ?)';
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ii', $user_id, $other_user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }
}
function recupererMessages($con, $user_id, $other_user_id) {
    $sql = 'SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC';
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }
    $stmt->bind_param('iiii', $user_id, $other_user_id, $other_user_id, $user_id);
    if (!$stmt->execute()) {
        echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        exit;
    }
    $result = $stmt->get_result();
    if (!$result) {
        echo "Erreur lors de la récupération du résultat : " . $con->error;
        exit;
    }
    $messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $messages;
}
$sql = 'SELECT * FROM serveurs_messages WHERE (user_id = ? AND other_user_id = ?) OR (user_id = ? AND other_user_id = ?)';
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param('iiii', $user_id, $other_user_id, $other_user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $serveur_messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    if (empty($serveur_messages)) {
        ouvrirServeurMessages($con, $user_id, $other_user_id);
    }
}
$messages = recupererMessages($con, $user_id, $other_user_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>Messages avec <?php echo htmlspecialchars($username); ?></title>
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Client/get_messages.js"></script>
    <link rel="stylesheet" href="../../CSS/Client/get_messages.css">
</head>
<?php
    include "Header.php";
?>
<body>
    <h1>Conversation avec <?php echo htmlspecialchars($username); ?></h1>
    <div class="messages">
        <ul>
    <?php foreach ($messages as $message) : ?>
        <?php $isCurrentUser = ($message['sender_id'] == $user_id); ?>
        <li class="<?php echo $isCurrentUser ? 'current-user' : 'other-user'; ?>" 
            onmouseenter="showButtons.call(this)" onmouseleave="hideButtons.call(this)">
            <?php echo htmlspecialchars($message['message']); ?>
            <?php if ($isCurrentUser) : ?>
                <div class="action-buttons" style="display:none;">
                    <button class="delete-btn" onclick="deleteMessage(<?php echo $message['id']; ?>)">Supprimer</button>
                </div>
            <?php else : ?>
                <div class="action-buttons" style="display:none;">
                    <button class="report-btn" onclick="reportMessage(<?php echo $message['id']; ?>)">Signaler</button>
                </div>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
        </ul>
    </div>
    <div class="container">
        <form action="envoyer_message.php" method="post" class="form-messages">
            <input type="hidden" name="receiver_id" value="<?php echo $other_user_id; ?>">
            <input type="hidden" name="conversation_id" value="<?php echo $conversation_id; ?>">
            <input type="text" name="message" placeholder="Votre message ici" required style="flex-grow: 1;">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>