<?php
header('Content-Type: application/json');
session_start();
include './LoginDatabase.php';
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message_id'])) {
    if ($stmt = $con->prepare('DELETE FROM messages WHERE id = ?')) {
        $stmt->bind_param('i', $_POST['message_id']);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $response['success'] = 'Utilisateur supprimé avec succès ! ';
        } else {
            $response['error'] = 'Erreur lors de la suppression de l\'utilisateur';
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