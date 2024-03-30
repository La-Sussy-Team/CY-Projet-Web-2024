<?php
include 'LoginDatabase.php';
if ($stmt = $con->prepare('SELECT id FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "exists";
    } else {
        echo "not exists";
    }
    $stmt->close();
}
$con->close();
?>