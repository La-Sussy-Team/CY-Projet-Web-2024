<?php
echo __DIR__;
include 'LoginDatabase.php';
// Vérifiez si le fichier a été uploadé sans erreur
if($_FILES['profileImage']['error'] == 0) {
    // Générer un nom unique pour le fichier pour éviter les conflits de noms
    $imageName = uniqid() . '-' . $_FILES['profileImage']['name'];
    $destination = __DIR__ . '/../../../Assets/Client/ProfileImage/' . $imageName;
    // Déplacez le fichier uploadé vers le répertoire des images
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $destination);
    // Ensuite, stockez le chemin de l'image (ou le nom de l'image) dans la base de données
    $stmt = $con->prepare("UPDATE infopersos SET imgpath = ? WHERE user_id = ?");
    $stmt->bind_param('si', $imageName, $userId);
    $stmt->execute();
}
?>