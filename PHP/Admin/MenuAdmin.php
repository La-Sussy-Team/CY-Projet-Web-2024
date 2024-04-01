<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300&display=swap">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://kit.fontawesome.com/54035b1df2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../../CSS/Admin/MenuAdmin.css">
	<script src="../../JS/Admin/MenuAdmin.js"></script>
</head>
<body>
	<div class="toggle" onclick="toggleMenu()"></div>
	<div class="navigation">
		<ul>
			<li>
				<a href="AccueilAdmin.php">
					<span class="icon"><i class="fa fa-home"></i></span>
					<span class="title">Accueil</span>
				</a>
			</li>
			<li>
				<a href="ListeUtilisateurs.php">
					<span class="icon"><i class="fa fa-graduation-cap"></i></span>
					<span class="title">Liste des utilisateurs</span>
				</a>
			</li>
			<li>
				<a href="GestionDepartement.php">
					<span class="icon"><i class="fa fa-location-dot" aria-hidden="true"></i></span>
					<span class="title">Info département</span>
				</a>
			</li>
			<li>
				<a href="GestionEssentiel.php">
					<span class="icon"><i class="fa fa-circle-info" aria-hidden="true"></i></span>
					<span class="title">L’essentiel à savoir</span>
				</a>
			</li>
			<li>
				<a href="GestionAdmin.php">
					<span class="icon"><i class="fa fa-solid fa-address-card"></i></span>
					<span class="title">Gestion des admins</span>
				</a>
			</li>
			<li>
				<a href="Logout.php">
					<span class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>
					<span class="title">Sortir de l'espace Administrateur</span>
				</a>
			</li>
		</ul>
	</div>
</body>
</html>