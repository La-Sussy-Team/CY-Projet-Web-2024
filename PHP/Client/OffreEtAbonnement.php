<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/OffreEtAbonnement.css">
    <title>PersonaliTree - Rencontre par affinité naturelle</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function confirmerAbonnement() {
            if (confirm("Êtes-vous sûr de vouloir vous abonner ?")) {
                // Envoi d'une requête AJAX pour mettre à jour le statut d'abonnement
                $.ajax({
                    url: 'MajStatutAbo.php',
                    type: 'POST',
                    data: { abonnement: 'abonne' },
                    success: function(response) {
                        // Si la mise à jour réussit, afficher un message de confirmation
                        alert("Vous êtes maintenant abonné !");
                    },
                    error: function(xhr, status, error) {
                        // En cas d'erreur, afficher un message d'erreur
                        alert("Une erreur s'est produite lors de la mise à jour de votre statut d'abonnement.");
                    }
                });
            }
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="box1">
            <div class="int">
                <div class="int_h2">
                    <h2>Découvrez notre offre d'abonnement</h2>
                </div>
                <div class="separator"></div>
                <div class="int_h1">
                    <h1>Pour profiter de toutes les fonctionnalités de PersonaliTree n'attendez plus et souscrivez tout de suite à un abonnement</h1>
                </div>
                <div class="separator"></div>
                <div class="int_p">
                    <p>+ Consulter le profil des autres utilisateurs </p>
                    <p>+ Connaitre les utilisateurs qui visite votre profil</p>
                    <p>+ Echanger des messages avec les autres utilisateurs</p>
                    <p>+ Bloquer des utilisateurs</p>
                </div>
                <div class="int_a">
                    <!-- Appel de la fonction confirmerAbonnement() lors du clic sur le lien -->
                    <a class="button" href="#" onclick="confirmerAbonnement()">S'abonner</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
