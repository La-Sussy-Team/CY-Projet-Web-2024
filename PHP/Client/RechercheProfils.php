<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/PageAccueil.css">
    <link rel="stylesheet" href="../../CSS/Header.css">
    <link rel="stylesheet" href="../../CSS/Client/RechercheProfils.css">
    <link rel="icon" href="../../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonaliTree - Rencontre par affinité naturelle</title>
</head>
<?php
include "Header.php";
?>
<body>
    <div class="filter-bar" id="filter-bar">
        <div class="deroulant">
        <form method="post">
         <div class="info-general">
            <input type="text" class="filter-searchbar" placeholder="Nom" name="search-nom">
            <input type="text" class="filter-searchbar" placeholder="Ville" name="search-ville">
            <input type="text" class="filter-searchbar" placeholder="Pays" name="search-pays">
         </div>
         <div class="sex">
            <input type="checkbox" class="checkbox-sex" name="sex1"> <label for="sex1">Homme</label>
            <input type="checkbox" class="checkbox-sex" name="sex2"> <label for="sex2">Femme</label>
            <input type="checkbox" class="checkbox-sex" name="sex3"> <label for="sex3">Autre</label>
         </div>
    <div class="age">
            <p>Age</p>
            <input type="text" placeholder="Minimum">
            <input type="text" placeholder="Maximum">
    </div>
    <button name="submit">Rechercher</button>
</form>
</div>
</div>
<div class="unroll-button" onclick="menu()">
<script>
    function menu(){
    const menu = document.getElementById("filter-bar");
    if(menu.classList.contains("active")==false){
        menu.classList.add("active");
    } else {
        menu.classList.remove("active");
    }
    }
</script>
<p>+</p>
</div>
<div class="result">
<table class="table">

    <?php
        include 'BackEnd/LoginDatabase.php';
        if(isset( $_POST['submit'])) {
            $nom=$_POST['search-nom'];
            $ville=$_POST['search-ville'];
            echo("<p>$nom</p>");
            if ($stmt = $con->prepare('SELECT * FROM login INNER JOIN infopersos ON login.id = infopersos.user_id WHERE nom LIKE ?')) {
                $nom = "%" . $nom . "%";
                $stmt->bind_param('s', $nom);
                $stmt->execute();
                $result = $stmt->get_result();
                $profil = $result->fetch_all(MYSQLI_ASSOC);
            }
            foreach($profil as $prof){
                echo("<p>wow</p>");
                echo("<tr>");   
                echo("<td>");
                echo("<p>".$prof['prenom']." ".$prof['nom']."</p>");
                echo("<p>".$prof['sexe']."</p>");
                echo("<p>".$prof['ville']."</p>");
                echo("<p>".$prof['pays']."</p>");
                echo("</td>");
                echo("</tr>");
            }
        }
    ?>
</table>
</div>
</body>
</html>