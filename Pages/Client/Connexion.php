<?php

session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	header('Location: Connexion.php');
    exit;
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: AccueilAdmin.php');
        } else {
            // Incorrect password
            $_SESSION['error'] = 1;
            header('Location: Connexion.php');
            exit;
        }
    } else {
        // Incorrect username
        $_SESSION['error'] = 1;
        header('Location: Connexion.php');
        exit;
    }
	$stmt->close();
}

?>
<!DOCTYPE php>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonaliTree - Page de connexion</title>
    <link rel="stylesheet" href="../../CSS/Connexion.css" type="text/css" media="all">
</head>
<body>
    <header>
        <h1>PersonaliTree</h1>
        <p>Connexion</p>
    </header>

    <form>
    <label for="login">Nom D'utilisateur</label><br>
    <input type="text" id="login" name="login"><br>
    <label for="login">Mot de passe</label><br>
    <input type="password" id="login" name="login"><br>


    </form>
</body>