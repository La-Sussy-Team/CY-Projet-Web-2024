<?php
header('Content-Type: application/json');
session_start();
include 'LoginDatabase.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['email'], $_POST['tel'], $_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['ville'], $_POST['adresse'], $_POST['pays'])){
    if (!preg_match("/^[A-Za-z0-9]+$/", $_POST['username'])) {
        $response['error'] = 'Le nom d\'utilisateur ne doit contenir que des lettres et des chiffres';
        echo json_encode($response);
        exit();
    }
    if ($_POST['password'] !== $_POST['passwordConfirmation']) {
        $response['error'] = 'Les mots de passes ne corespendent pas';
        echo json_encode($response);
        exit();
    }
    include './LoginDatabase.php';
    if ($stmt = $con->prepare('SELECT id FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $response['error'] = 'Nom d\'utilisateur déjà utilisé';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['error'] = 'Erreur SQL';
        echo json_encode($response);
        exit();
    }
    if ($stmt = $con->prepare('SELECT user_id FROM infopersos WHERE email = ? OR phone = ?')) {
        $stmt->bind_param('ss', $_POST['email'], $_POST['tel']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $response['error'] = 'Email ou téléphone déjà utilisé';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['error'] = 'Erreur SQL';
        echo json_encode($response);
        exit();
    }
    if ($stmt = $con->prepare('INSERT INTO login (username, password) VALUES (?, ?)')) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $_POST['username'], $password);
        $stmt->execute();
        $last_id = $con->insert_id;
        if ($stmt = $con->prepare('INSERT INTO infopersos (user_id, email, phone, prenom, nom, sexe, ville, adresse, pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
            $stmt->bind_param('isissssss', $last_id, $_POST['email'], $_POST['tel'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['ville'], $_POST['adresse'], $_POST['pays']);
            $stmt->execute();
            if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
                $imageName = uniqid() . '-' . $_FILES['profileImage']['name'];
                $destination = __DIR__ . '/../../../Assets/Client/ProfileImage/' . $imageName;
                if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $destination)) {
                    $stmt = $con->prepare("UPDATE infopersos SET imgpath = ? WHERE user_id = ?");
                    $stmt->bind_param('si', $imageName, $last_id);
                    $stmt->execute();
                    $stmt->close();
                    $con->close();
                    $response['success'] = 'Inscription réussie';
                    echo json_encode($response);
                    exit();
                } else {
                    $response['error'] = 'Erreur lors du téléchargement de l\'image';
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['success'] = 'Inscription réussie';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['error'] = 'Erreur SQL';
            echo json_encode($response);
            exit();
        }
        session_regenerate_id();
        $_SESSION['username'] = $_POST['username'];
        header('Location: AccueilProfils.php');
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