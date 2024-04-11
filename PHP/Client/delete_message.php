<?php

include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';

if (isset($_POST['messageId'])) {
    $messageId = $_POST['messageId'];
    if ($stmt = $con->prepare("DELETE FROM messages WHERE id = ?")){
        $stmt->bind_param("i", $messageId);
        $stmt->execute();
        $stmt->close();
        echo "Message deleted successfully.";
    }
    else {
        echo "Error deleting message.";
    }
}
?>
