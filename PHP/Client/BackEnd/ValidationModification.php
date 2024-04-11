<?php
header('Content-Type: application/json');
session_start();
include 'LoginDatabase.php';
if ($stmt = $con->prepare('SELECT password, id FROM login WHERE username = ?')) {
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $login = $result->fetch_assoc();
    if (!password_verify($_POST['currentPassword'], $login['password'])) {
        $response['error'] = 'Mot de passe incorrect';
        echo json_encode($response);
        exit();
    }
} else {
    $response['error'] = 'Erreur SQL';
    echo json_encode($response);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['tel'], $_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['ville'], $_POST['adresse'], $_POST['pays'], $_POST['dateNaissance'], $_POST['bio'], $_POST['interets'])){
    if ($_POST['password'] !== $_POST['passwordConfirmation']) {
        $response['error'] = 'Les mots de passes ne corespendent pas';
        echo json_encode($response);
        exit();
    }
    include './LoginDatabase.php';
    if ($_POST['password'] != '') {
        if ($stmt = $con->prepare('UPDATE login SET password=? WHERE id=?')) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('si', $password, $login['id']);
            $stmt->execute();
        } else {
            $response['error'] = 'Erreur SQL';
            echo json_encode($response);
            exit();
        }
    }
    if ($stmt = $con->prepare('UPDATE infopersos SET email=?, phone=?, prenom=?, nom=?, sexe=?, dateNaissance=?, ville=?, adresse=?, pays=?, bio=?, interets=? WHERE user_id=?')) {
        $stmt->bind_param('sssssssssssi', $_POST['email'], $_POST['tel'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['dateNaissance'], $_POST['ville'], $_POST['adresse'], $_POST['pays'], $_POST['bio'], $_POST['interets'], $login['id']);
        $stmt->execute();
        if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
            $currentImagePath = __DIR__ . '/../../../Assets/Client/ProfileImage/' . $_POST['currentProfileImage'];
            if (file_exists($currentImagePath) && $_POST['currentProfileImage'] != 'default.jpg') {
                unlink($currentImagePath);
            }
            $imageName = uniqid() . '-' . $_FILES['profileImage']['name'];
            $destination = __DIR__ . '/../../../Assets/Client/ProfileImage/' . $imageName;
            if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $destination)) {
                $stmt = $con->prepare("UPDATE infopersos SET imgpath = ? WHERE user_id = ?");
                $stmt->bind_param('si', $imageName, $login['id']);
                $stmt->execute();
                $stmt->close();
                $con->close();
                $response['success'] = 'Modification réussie 1';
                echo json_encode($response);
                exit();
            } else {
                $response['error'] = 'Erreur lors du téléchargement de l\'image';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['success'] = 'Modification réussie 2';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['error'] = 'Erreur SQL';
        echo json_encode($response);
        exit();
    }
} else {
    $response['error'] = 'Erreur POST';
    echo json_encode($response);
    exit();
}
?>