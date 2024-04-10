<?php
header('Content-Type: application/json');
session_start();
include './LoginDatabase.php';
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message_id'])) {
    if ($stmt = $con->prepare('UPDATE messages SET isReported = 0 WHERE id = ?')) {
        $stmt->bind_param('i', $_POST['message_id']);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $response['success'] = 'Message ignoré avec succès !';
        } else {
            $response['error'] = 'Erreur : impossible d\'ignorer le message';
        }
    } else {
        $response['error'] = 'Erreur SQL';
    }
} else {
    $response['error'] = 'Erreur POST';
}   
echo json_encode($response);
exit();
?>