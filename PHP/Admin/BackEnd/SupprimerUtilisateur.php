<?php
header('Content-Type: application/json');
session_start();
include 'LoginDatabase.php';
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    if ($stmt = $con->prepare('SELECT id FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->bind_result($userId);
        if ($stmt->fetch()) {
            $stmt->close();
            if ($stmt = $con->prepare('DELETE FROM login WHERE id = ?')) {
                $stmt->bind_param('i', $userId);
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
            $response['error'] = 'Aucun utilisateur trouvé avec ce pseudo';
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