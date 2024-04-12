<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';
if (isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];
    $stmt = $con->prepare("UPDATE messages SET isReported = 1 WHERE id = ?");
    $stmt->bind_param('i', $messageId);
    $stmt->execute();
    $stmt->close();
}
?>