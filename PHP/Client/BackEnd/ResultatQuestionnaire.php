<?php
session_start();
include './LoginDatabase.php';
if (!isset($_POST['q1']) || !isset($_POST['q2']) || !isset($_POST['q3']) || !isset($_POST['q4']) || !isset($_POST['q5']) || !isset($_POST['q6']) || !isset($_POST['q7'])) {
    header("Location: ../Questionnaire.php");
    exit();
} else {
    if ($stmt = $con->prepare('SELECT id FROM login WHERE username = ?')) {
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userid);
            $stmt->fetch();
        } else {
            header("Location: ../Questionnaire.php");
            exit();
        }
    } else {
        header("Location: ../Questionnaire.php");
        exit();
    }
    $plantes = array(
        "Broméliacées " => array("x" => 0, "y" => 0),
        "Chlorophytum " => array("x" => 1, "y" => 2),
        "Cactus " => array("x" => 3, "y" => 2),
        "Lierre" => array("x" => 6, "y" => 3),
        "Orchidée" => array("x" => 2, "y" => 5),
        "Lavande" => array("x" => 0, "y" => 3),
        "Oiseau de paradis" => array("x" => 1, "y" => 3),
        "Pothos" => array("x" => 0, "y" => 1),
        "Dracaena citron" => array("x" => 2, "y" => 2),
        "Olivier" => array("x" => 1, "y" => 5),
        "Tradescantia" => array("x" => 3, "y" => 3),
    );
    $reponses = array(
        "q1a" => array("x" => 2, "y" => 3),
        "q1b" => array("x" => 1, "y" => 4),
        "q1c" => array("x" => 3, "y" => 2),
        "q1d" => array("x" => 4, "y" => 2),
        "q1e" => array("x" => 1, "y" => 2),
        "q1f" => array("x" => 0, "y" => 5),
        "q1g" => array("x" => -3, "y" => 3),
        "q1h" => array("x" => 1, "y" => 1),
        "q1i" => array("x" => -4, "y" => 1),
        "q1j" => array("x" => 3, "y" => 3),
        "q1k" => array("x" => 2, "y" => 5),
        "q2a" => array("x" => 2, "y" => 2),
        "q2b" => array("x" => 3, "y" => 3),
        "q2c" => array("x" => 2, "y" => 1),
        "q2d" => array("x" => 1, "y" => 1),
        "q2e" => array("x" => 3, "y" => 2),
        "q2f" => array("x" => 1, "y" => 4),
        "q2g" => array("x" => 0, "y" => 3),
        "q2h" => array("x" => 2, "y" => 3),
        "q2i" => array("x" => -2, "y" => 1),
        "q2j" => array("x" => 3, "y" => 4),
        "q2k" => array("x" => 4, "y" => 4),
        "q3a" => array("x" => 3, "y" => 3),
        "q3b" => array("x" => 2, "y" => 4),
        "q3c" => array("x" => 4, "y" => 2),
        "q3d" => array("x" => 5, "y" => 2),
        "q3e" => array("x" => 2, "y" => 2),
        "q3f" => array("x" => 1, "y" => 3),
        "q3g" => array("x" => -3, "y" => 4),
        "q3h" => array("x" => 1, "y" => 1),
        "q3i" => array("x" => -4, "y" => 1),
        "q3j" => array("x" => 3, "y" => 3),
        "q3k" => array("x" => 2, "y" => 5),
        "q4a" => array("x" => 3, "y" => 4),
        "q4b" => array("x" => 2, "y" => 3),
        "q4c" => array("x" => 4, "y" => 2),
        "q4d" => array("x" => 3, "y" => 3),
        "q4e" => array("x" => 1, "y" => 2),
        "q4f" => array("x" => 4, "y" => 1),
        "q4g" => array("x" => 2, "y" => 4),
        "q4h" => array("x" => 1, "y" => 1),
        "q4i" => array("x" => -3, "y" => 2),
        "q4j" => array("x" => 3, "y" => 3),
        "q4k" => array("x" => 4, "y" => 4),
        "q5a" => array("x" => 2, "y" => 2),
        "q5b" => array("x" => 1, "y" => 3),
        "q5c" => array("x" => 3, "y" => 1),
        "q5d" => array("x" => 4, "y" => 2),
        "q5e" => array("x" => 2, "y" => 1),
        "q5f" => array("x" => 0, "y" => 4),
        "q5g" => array("x" => -3, "y" => 3),
        "q5h" => array("x" => 1, "y" => 1),
        "q5i" => array("x" => -4, "y" => 1),
        "q5j" => array("x" => 3, "y" => 3),
        "q5k" => array("x" => 2, "y" => 5),
        "q6a" => array("x" => 3, "y" => 2),
        "q6b" => array("x" => 2, "y" => 3),
        "q6c" => array("x" => 4, "y" => 1),
        "q6d" => array("x" => 5, "y" => 3),
        "q6e" => array("x" => 2, "y" => 2),
        "q6f" => array("x" => 1, "y" => 4),
        "q6g" => array("x" => -3, "y" => 4),
        "q6h" => array("x" => 1, "y" => 1),
        "q6i" => array("x" => -4, "y" => 2),
        "q6j" => array("x" => 3, "y" => 3),
        "q6k" => array("x" => 4, "y" => 5),
        "q7a" => array("x" => 2, "y" => 2),
        "q7b" => array("x" => 3, "y" => 3),
        "q7c" => array("x" => 2, "y" => 1),
        "q7d" => array("x" => 1, "y" => 1),
        "q7e" => array("x" => 3, "y" => 2),
        "q7f" => array("x" => 1, "y" => 4),
        "q7g" => array("x" => -3, "y" => 3),
        "q7h" => array("x" => 1, "y" => 1),
        "q7i" => array("x" => -4, "y" => 1),
        "q7j" => array("x" => 3, "y" => 3),
        "q7k" => array("x" => 2, "y" => 5),
    );
    $score = array("x" => 0, "y" => 0);
    for ($i = 1; $i <= 7; $i++) {
        $key = 'q' . $i . $_POST['q' . $i];
        if (isset($reponses[$key])) {
            $score["x"] += $reponses[$key]["x"];
            $score["y"] += $reponses[$key]["y"];
        }
    }
    $x = $score["x"] / 7;
    $y = $score["y"] / 7;
    echo "x = " . $x . " y = " . $y;
    $planteProche = "";
    $distanceMin = PHP_INT_MAX;
    foreach ($plantes as $nom => $coordonnees) {
        $distance = sqrt(pow($coordonnees['x'] - $x, 2) + pow($coordonnees['y'] - $y, 2));
        if ($distance < $distanceMin) {
            $distanceMin = $distance;
            $planteProche = $nom;
        }
    }
    echo "La plante la plus proche est : " . $planteProche;
    if ($stmt = $con->prepare('SELECT id FROM plante WHERE plante = ?')) {
        $stmt->bind_param('s', $planteProche);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_plante);
            $stmt->fetch();
        } else {
            exit();
        }
        if ($stmt = $con->prepare('INSERT INTO relationplante (id, id_plante, x, y) VALUES (?, ?, ?, ?)')) {
            $stmt->bind_param('iidd', $userid, $id_plante, $x, $y);
            $stmt->execute();
            $stmt->close();
            $con->close();
            $_SESSION['questionnaire'] = 1;
            header("Location: ../MonProfil.php");
            exit();
        } else {
            header("Location: ../Questionnaire.php");
            exit();
        }
    } else {
        header("Location: ../Questionnaire.php");
        exit();
    }
}
?>