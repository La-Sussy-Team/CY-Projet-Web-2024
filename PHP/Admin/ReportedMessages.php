<?php
include "./BackEnd/VerificationConnexionAdmin.php";
include "../Client/BackEnd/LoginDatabase.php";
if ($stmt = $con->prepare('SELECT m.id AS message_id, m.sender_id, m.receiver_id, m.message, m.timestamp, s.username AS sender_username, r.username AS receiver_username FROM messages m JOIN login s ON m.sender_id = s.id JOIN login r ON m.receiver_id = r.id WHERE m.isReported = 1')){
    $stmt -> execute();
    $result = $stmt -> get_result();
    $message = $result -> fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0" />
    <title>Personalytree - Administration</title>
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <link rel="stylesheet" href="../../CSS/Admin/ReportedMessages.css">
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
    <script src="../../JS/Admin/ReportedMessages.js"></script>
</head>

<?php
include "Header.php";
?>
<body>
    <div class="Head" style="display: flex;flex: auto;justify-content: center;"><h1>Messages Signalés</h1></div>
    <div class="Body" style="display: flex;flex: auto;justify-content: center;">
        <table>
            <?php
            if (empty($message)){
                echo "<tr><th><h2 style='text-align: center;'>Aucun message signalé</h2></th></tr>";
            } else {
                echo "<tr><th>Expéditeur</th><th>Destinataire</th><th>Contenu</th><th>Date</th><th>Supprimer</th><th>Ignorer</th><th>Bannir l'utilisateur</th></tr>";
                foreach ($message as $row){
                    echo "<tr><td><a href='GestionUtilisateur.php?username=".urlencode($row['sender_username'])."'>".$row['sender_username']."</a></td><td><a href='GestionUtilisateur.php?username=".urlencode($row['receiver_username'])."'>".$row['receiver_username']."</td><td class=\"limited-width\">".$row['message']."</td><td>".$row['timestamp']."</td><td><button class='supprimer' data-message-id=\"".$row['message_id']."\">Supprimer</button></td><td><button class='ignore' data-message-id=\"".$row['message_id']."\">Ignorer</button></td>";
                    if ($stmt = $con->prepare('SELECT * FROM login WHERE username = ?')){
                        $stmt -> bind_param('s', $row['sender_username']);
                        $stmt -> execute();
                        $result = $stmt -> get_result();
                        $sender = $result -> fetch_assoc();
                        if ($sender['isBanned'] == 1){
                            echo "<td>Utilisateur banni</td></tr>";
                        } else {
                            echo "<td><button class='ban' data-username=\"".$row['sender_username']."\">Bannir l'utilisateur</button></td></tr>";
                        }
                    }
                }
            }
            ?>
        </table>
    </div>
</body>
</html>