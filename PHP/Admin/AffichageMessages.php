<?php
include './BackEnd/VerificationConnexionAdmin.php';
include './BackEnd/LoginDatabase.php';
if (!isset($_GET['other_user_id'])) {
    header('Location: ./GererMessages.php');
    exit;
}
$other_user_id = $_GET['other_user_id'];
$user_id = $_GET['user_id'];
$stmt = $con->prepare("SELECT id FROM conversation WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?) LIMIT 1");
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
    <link rel="stylesheet" href="../../CSS/Admin/AffichageMessages.css">
</head>
<body>
    <h1>Conversation avec <?php echo htmlspecialchars($username); ?></h1>
    <div class="messages">
        <ul>
            <?php foreach ($messages as $message) : ?>
                <?php if($message['sender_id'] == $user_id): ?>
                    <li class="current-user"><?php echo htmlspecialchars($message['message']); ?></li>
                <?php else: ?>
                    <li class="other-user"><?php echo htmlspecialchars($message['message']); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            
        </ul>
    </div>
    <div class="container">
        <div class="messages">
        </div>
    </div>
</body>
</html>