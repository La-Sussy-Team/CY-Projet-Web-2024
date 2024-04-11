<?php
include './BackEnd/VerificationConnexion.php';
include './BackEnd/LoginDatabase.php';

// Vérifier si l'identifiant de l'utilisateur avec lequel l'utilisateur connecté a une conversation est présent dans la requête GET
if (!isset($_GET['other_user_id'])) {
    header('Location: conversation.php'); // Rediriger si l'identifiant de l'utilisateur manque
    exit;
}


// Récupérer l'identifiant de l'utilisateur avec lequel l'utilisateur connecté a une conversation à partir de la requête GET
$other_user_id = $_GET['other_user_id'];

$user_id = null;
$username = $_SESSION['username']; // Supposons que le nom d'utilisateur est stocké dans la session

// Requête SQL pour récupérer l'ID de l'utilisateur en fonction du nom d'utilisateur
$stmt = $con->prepare('SELECT id FROM login WHERE username = ?');
if ($stmt) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();
}


$sql = "SELECT id FROM conversation WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?) LIMIT 1";
 
// Préparez la requête
$stmt = $con->prepare($sql);
if ($stmt) {
    // Liez les valeurs des paramètres et exécutez la requête
    $stmt->bind_param("iiii", $user_id, $other_user_id, $other_user_id, $user_ids);
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
    $stmt->bind_param('iiii', $user_id, $other_user_id, $other_user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $serveur_messages = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    // Si aucun serveur de messages n'est ouvert, ouvrir un nouveau serveur
    if (empty($serveur_messages)) {
        ouvrirServeurMessages($con, $user_id, $other_user_id);
    }
}

// Récupérer tous les messages entre l'utilisateur connecté et l'utilisateur sélectionné
$messages = recupererMessages($con, $user_id, $other_user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages avec <?php echo htmlspecialchars($username); ?></title>
    <script src="../../JS/Librairies/jquery-3.7.1.min.js"></script>
</head>
<?php
        include "Header.php";
    ?>
<body>
    <h1>Conversation avec <?php echo htmlspecialchars($username); ?></h1>

    <!-- Afficher les messages -->
    <div class="messages">
        <ul>
<style>


    h1 {
        margin-top: 7vw;
        text-align: center;
    }


    .messages {
        height: 60vh;
        width: 25vw;
        margin: 0 auto;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
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
        background-color: #92D668;
        color: white;
        margin-left: 20%;
        text-align: right;
    }

    /* Style pour la fenêtre modale */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


</style>


<script>
// Définition de la fonction pour supprimer un message
function deleteMessage(messageId) {
    console.log(messageId);
    if (confirm("Êtes-vous sûr de vouloir supprimer ce message ?")) {
        $.ajax({
            url: 'delete_message.php',
            type: 'POST',
            data: { messageId: messageId },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite lors de la suppression du message.");
            }
        });
    }
}

// Définition de la fonction pour signaler un message
function reportMessage(messageId) {
    console.log(messageId);
    $.ajax({
        url: 'report_message.php',
        type: 'POST',
        data: { messageId: messageId },
        success: function(response) {
            alert("Le message a été signalé avec succès.");
        },
        error: function(xhr, status, error) {
            alert("Une erreur s'est produite lors du signalement du message.");
        }
    });
}
</script>




        <script>
// Fonction pour afficher les boutons de suppression et de signalement
function showButtons() {
    $(this).find('.action-buttons').show();
}

// Fonction pour masquer les boutons de suppression et de signalement
function hideButtons() {
    $(this).find('.action-buttons').hide();
}
</script>

    <?php foreach ($messages as $message) : ?>
        <?php $isCurrentUser = ($message['sender_id'] == $user_id); ?>
        <li class="<?php echo $isCurrentUser ? 'current-user' : 'other-user'; ?>" 
            onmouseenter="showButtons.call(this)" onmouseleave="hideButtons.call(this)">
            <?php echo htmlspecialchars($message['message']); ?>
            <?php if ($isCurrentUser) : ?>
                <div class="action-buttons" style="display:none;">
                    <button class="delete-btn" onclick="deleteMessage(<?php echo $message['id']; ?>)">Supprimer</button>
                </div>
            <?php else : ?>
                <div class="action-buttons" style="display:none;">
                    <button class="report-btn" onclick="reportMessage(<?php echo $message['id']; ?>)">Signaler</button>
                </div>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>




        </ul>
    </div>



    <style>

        .messages {
            max-height: 60vh;
            overflow-y: auto;
        }

        .messages li {
            display: inline-block;
            max-width: 60%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 20px;
            position: relative;
            line-height: 1.3;
            clear: both;
        }
        .messages .current-user {
            word-wrap: break-word;
            background-color: #92D668;
            color: white;
            float: right;
            text-align: left;
            over
        }
        .messages .current-user::after {
            content: "";
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 10px solid #92D668;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
        }
        .messages .other-user {
            word-wrap: break-word;
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
            background-color: #92D668;
            color: white;
            cursor: pointer;
        }

        .report-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #92D668;
            color: white;
            cursor: pointer;
        }

        .delete-btn{
            
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            background-color: #e6e6e6;
            color: white;
            cursor: pointer;
        }


        button:hov {
            background-color: #007acc;
        }



    </style>


    

<style>

    .container {
        display: flex;
        flex-direction: column;
        margin-top: 35vw;
    }
</style>

<div class="container">
    

    <form action="envoyer_message.php" method="post" class="form-messages">
        <input type="hidden" name="receiver_id" value="<?php echo $other_user_id; ?>">
        <input type="hidden" name="conversation_id" value="<?php echo $conversation_id; ?>">
        <input type="text" name="message" placeholder="Votre message ici" required style="flex-grow: 1;">
        
        <button type="submit">Envoyer</button>
    </form>
    <script>
        var messagesContainer = document.querySelector('.messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
    </form>
</div>


</body>
</html>

