<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin'])) {
    header('Location: connexion.php');
    exit;
}

// Vérifier si l'identifiant de l'utilisateur avec lequel l'utilisateur connecté a une conversation est présent dans la requête GET
if (!isset($_GET['other_user_id'])) {
    header('Location: conversation.php'); // Rediriger si l'identifiant de l'utilisateur manque
    exit;
}


// Inclure le fichier de configuration de la base de données
include 'config.php';

// Récupérer l'identifiant de l'utilisateur avec lequel l'utilisateur connecté a une conversation à partir de la requête GET
$other_user_id = $_GET['other_user_id'];

$sql = "SELECT id FROM conversation WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?) LIMIT 1";
    
// Préparez la requête
$stmt = $con->prepare($sql);
if ($stmt) {
    // Liez les valeurs des paramètres et exécutez la requête
    $stmt->bind_param("iiii", $_SESSION['id'], $other_user_id, $other_user_id, $_SESSION['id']);
    $stmt->execute();
    
    // Récupérez le résultat de la requête
    $result = $stmt->get_result();
    
    // Vérifiez s'il y a des résultats
    if ($result->num_rows > 0) {
        // Récupérez l'ID de la conversation
        $row = $result->fetch_assoc();
        $conversation_id = $row['id'];
    }
}

$stmt = $con->prepare('SELECT username FROM login WHERE id = ?');
if ($stmt) {
    $stmt->bind_param('i', $other_user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
}

// Vérifier si un serveur de messages est ouvert entre les deux utilisateurs
// Si ce n'est pas le cas, ouvrez un nouveau serveur de messages
// Si un serveur de messages est déjà ouvert, connectez simplement l'utilisateur à ce serveur

// Fonction pour ouvrir un nouveau serveur de messages
function ouvrirServeurMessages($con, $user_id, $other_user_id) {
    // Insérer une nouvelle entrée dans la table des serveurs de messages
    $sql = 'INSERT INTO serveurs_messages (user_id, other_user_id) VALUES (?, ?)';
    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ii', $user_id, $other_user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Gérer l'erreur de préparation de la requête
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }
}

// Fonction pour récupérer tous les messages entre deux utilisateurs
function recupererMessages($con, $user_id, $other_user_id) {
    // Sélectionner tous les messages entre les deux utilisateurs
    $sql = 'SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC';
    $stmt = $con->prepare($sql);
    if (!$stmt) {
        // Gérer l'erreur de préparation de la requête
        echo "Erreur de préparation de la requête : " . $con->error;
        exit;
    }

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param('iiii', $user_id, $other_user_id, $other_user_id, $user_id);
    if (!$stmt->execute()) {
        // Gérer l'erreur d'exécution de la requête
        echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
        exit;
    }

    // Récupérer le résultat de la requête
    $result = $stmt->get_result();
    if (!$result) {
        // Gérer l'erreur de récupération du résultat
        echo "Erreur lors de la récupération du résultat : " . $con->error;
        exit;
    }

    // Récupérer tous les messages
    $messages = $result->fetch_all(MYSQLI_ASSOC);

    // Fermer la requête
    $stmt->close();

    // Retourner les messages récupérés
    return $messages;
}


// Vérifier si un serveur de messages est ouvert entre les deux utilisateurs
$sql = 'SELECT * FROM serveurs_messages WHERE (user_id = ? AND other_user_id = ?) OR (user_id = ? AND other_user_id = ?)';
$stmt = $con->prepare($sql);
if ($stmt) {
    $stmt->bind_param('iiii', $_SESSION['id'], $other_user_id, $other_user_id, $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $serveur_messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    // Si aucun serveur de messages n'est ouvert, ouvrir un nouveau serveur
    if (empty($serveur_messages)) {
        ouvrirServeurMessages($con, $_SESSION['id'], $other_user_id);
    }
}

// Récupérer tous les messages entre l'utilisateur connecté et l'utilisateur sélectionné
$messages = recupererMessages($con, $_SESSION['id'], $other_user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages avec <?php echo htmlspecialchars($username); ?></title>
</head>
<body>
    <h1>Conversation avec <?php echo htmlspecialchars($username); ?></h1>

    <!-- Afficher les messages -->
    <div class="messages">
        <ul>
<style>
    .messages {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .messages ul {
        list-style-type: none;
        padding: 0;
    }
    .messages li {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
    }
    .messages .other-user {
        background-color: #e6e6e6;
        margin-right: 20%;
    }
    .messages .current-user {
        background-color: #0099ff;
        color: white;
        margin-left: 20%;
        text-align: right;
    }
</style>

            <?php foreach ($messages as $message) : ?>
                <?php if($message['sender_id'] == $_SESSION['id']): ?>
                    <li class="current-user"><?php echo htmlspecialchars($message['message']); ?></li>
                <?php else: ?>
                    <li class="other-user"><?php echo htmlspecialchars($message['message']); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            
        </ul>
    </div>

    <!-- Formulaire pour envoyer de nouveaux messages -->
    
    
    <style>
        .messages li {
            display: inline-block;
            max-width: 80%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            line-height: 1.3;
            clear: both;
        }
        .messages .current-user {
            background-color: #0099ff;
            color: white;
            float: right;
            text-align: left;
        }
        .messages .current-user::after {
            content: "";
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 10px solid #0099ff;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
        }
        .messages .other-user {
            background-color: #e6e6e6;
            float: left;
            text-align: left;
        }
        .messages .other-user::after {
            content: "";
            position: absolute;
            top: 0;
            left: -10px;
            width: 0;
            height: 0;
            border-top: 10px solid #e6e6e6;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
        }

        .form-messages {
            max-width: 600px;
            margin: 0 auto;
        }
        form {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        textarea {
            flex-grow: 1;
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="text"] {
            flex-grow: 1;
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #0099ff;
            color: white;
            cursor: pointer;
        }
        button:hov {
            background-color: #007acc;
        }
    </style>

    

<style>
    /* Ajoutez cette règle pour contrôler l'ordre d'affichage */
    .container {
        display: flex;
        flex-direction: column;
    }
</style>

<div class="container">
    <div class="messages">
        <!-- Vos messages ici -->
    </div>

    <form action="envoyer_message.php" method="post" class="form-messages">
        <input type="hidden" name="receiver_id" value="<?php echo $other_user_id; ?>">
        <input type="hidden" name="conversation_id" value="<?php echo $conversation_id; ?>">
        <textarea name="message" placeholder="Votre message ici" required style="flex-grow: 1;"></textarea>
        <button type="submit">Envoyer</button>
    </form>
</div>



</body>
</html>

