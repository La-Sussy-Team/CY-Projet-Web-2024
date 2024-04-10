<?php
header('Content-Type: application/json');
session_start();
include './LoginDatabase.php';
$response = array();
if ($stmt = $con->prepare('SELECT isAdmin FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $login = $result->fetch_assoc();
    $newIsAdmin = $login['isAdmin'] == 1 ? 0 : 1;
    if ($stmt = $con->prepare('UPDATE login SET isAdmin = ? WHERE username = ?')) {
        $stmt->bind_param('is', $newIsAdmin, $_POST['username']);
        $stmt->execute();
        $response['success'] = 'Modification réussie';
    } else {
        $response['error'] = 'Erreur SQL';
    }
} else {
    $response['error'] = 'Erreur SQL';
}
echo json_encode($response);
exit();
?>