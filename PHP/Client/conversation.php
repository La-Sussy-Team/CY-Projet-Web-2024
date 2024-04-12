<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
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
$sql = 'SELECT * FROM conversation WHERE user1_id = ? OR user2_id = ?';
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param('ii', $user_id, $user_id);
    $stmt->execute();
    $user_conversations_result = $stmt->get_result();
    $stmt->close();
    if ($user_conversations_result && $user_conversations_result->num_rows > 0) {
        $user_conversations = $user_conversations_result->fetch_all(MYSQLI_ASSOC);
    } else {
        $user_conversations = array();
    }
} else {
    echo "Erreur de préparation de la requête : " . $con->error;
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Conversations</title>
    <link rel="stylesheet" href="../../CSS/Client/Conversations.css">
</head>
<?php
        include "Header.php";
    ?>
<body>
    <div class="conv">
    <h1 class="titreconv">Conversations</h1>
    <div class="conversations">
    <?php if (!empty($user_conversations)) : ?>
        <ul>
            <?php foreach ($user_conversations as $conversation) : ?>
                <?php
                $other_user_id = ($conversation['user1_id'] == $user_id) ? $conversation['user2_id'] : $conversation['user1_id'];
                $stmt = $con->prepare('SELECT imgpath FROM infopersos WHERE user_id = ?');
                if ($stmt) {
                    $stmt->bind_param('i', $other_user_id);
                    $stmt->execute();
                    $stmt->bind_result($imgpath);
                    $stmt->fetch();
                    $stmt->close();
                    $image_other_user = isset($imgpath) ? $imgpath : '../../../Assets/Client/ProfileImage/default.jpg';
                } else {
                    echo "Erreur de préparation de la requête : " . $con->error;
                    exit;
                }
                $stmt = $con->prepare('SELECT username FROM login WHERE id = ?');
                if ($stmt) {
                    $stmt->bind_param('i', $other_user_id);
                    $stmt->execute();
                    $stmt->bind_result($other_username);
                    $stmt->fetch();
                    $stmt->close();
                }
                $last_message = null;
                $stmt = $con->prepare('SELECT message FROM messages WHERE conversation_id = ? ORDER BY id DESC LIMIT 1');
                if ($stmt) {
                    $stmt->bind_param('i', $conversation['id']);
                    $stmt->execute();
                    $stmt->bind_result($last_message);
                    $stmt->fetch();
                    $stmt->close();
                }
                if ($last_message == null) {
                    $last_message = "Aucun message";
                }
                ?>
                <div class="conversation-module" onclick="window.location='get_messages.php?user_id=<?php echo $user_id ?>&other_user_id=<?php echo $other_user_id; ?>'" > 
                    <img src="../../../Assets/Client/ProfileImage/<?php echo $image_other_user; ?>" alt="Profile Image">
                    <p ><?php echo htmlspecialchars($other_username); ?></p>
                    <p>Dernier message : <?php echo htmlspecialchars($last_message); ?></p>
                </div>
        <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucune conversation disponible.</p>
    <?php endif; ?>
</div>
</div>
</body>
</html>
