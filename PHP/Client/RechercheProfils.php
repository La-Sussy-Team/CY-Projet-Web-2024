<?php
include "BackEnd/VerificationConnexion.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/PageAccueil.css">
    <link rel="stylesheet" href="../../CSS/Header.css">
    <link rel="stylesheet" href="../../CSS/Client/RechercheProfils.css">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
    <link rel="icon" href="../../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Rencontre par affinité naturelle</title>
</head>
<?php
include "Header.php";
?>
<body>
    <div class="filter-bar" id="filter-bar">
        <h3 style="text-align: center;">Filtrez votre recherche</h3>
        <div class="deroulant">
        <form method="post">
        <div class="info-general">
            <input type="text" class="filter-searchbar" placeholder="Nom" name="search-nom">
            <input type="text" class="filter-searchbar" placeholder="Ville" name="search-ville">
            <input type="text" class="filter-searchbar" placeholder="Pays" name="search-pays">
        </div>
        <div class="sex">
            <input type="checkbox" class="checkbox-sex" name="sex1" value="Homme"> <label for="sex1">Homme</label>
            <input type="checkbox" class="checkbox-sex" name="sex2" value="Femme"> <label for="sex2">Femme</label>
            <input type="checkbox" class="checkbox-sex" name="sex3" value="Autre"> <label for="sex3">Autre</label>
        </div>
        <div class="desc">
            <input type="text" class="filter-desc" name="desc" placeholder="Mots clés (séparés avec une ',')">
            <input type="number" class="filter-age-min" name="age-min" placeholder="Age minimum">
            <input type="number" class="filter-age-max" name="age-max" placeholder="Age maximum">
        </div>
    <button name="submit">Rechercher</button>
</form>
</div>
</div>
<div id="unroll-button" class="unroll-button" onclick="menu()">
<script>
    function menu(){
    const menu = document.getElementById("filter-bar");
    const bouton = document.getElementById("unroll-button");
    if(menu.classList.contains("active")==false){
        menu.classList.add("active");
        bouton.classList.add("active");
    } else {
        menu.classList.remove("active");
        bouton.classList.remove("active");
    }
    }
</script>
<p>   +   </p>
</div>
<div class="result">
    <table class="table">
    <?php
        include 'BackEnd/LoginDatabase.php';
        $nom=null;
        $ville=null;
        $pays=null;
        $keyword=null;
        $agemin=0;
        $agemax=200;
        if(isset( $_POST['submit'])) {
            $nom=$_POST['search-nom'];
            $ville=$_POST['search-ville'];
            $pays=$_POST['search-pays'];
            if(isset($_POST['sex1'])){
            $sexe1=$_POST['sex1'];
            } else {
                $sexe1="";
            }
            if(isset($_POST['sex2'])){
            $sexe2=$_POST['sex2'];
            }else {
                $sexe2="";
            }
            if(isset($_POST['sex3'])){
            $sexe3=$_POST['sex3'];
            }else {
                $sexe3="";
            }
            if($sexe1=="" && $sexe2=="" && $sexe3==""){
                $sexe1="Homme";
                $sexe2="Femme";
                $sexe3="Autre";
            }
            if(isset($_POST['desc'])){
            $keyword= explode(",",$_POST['desc']);
            }
            if($_POST['age-min']!=""){
                $agemin= $_POST['age-min'];
            }
            if($_POST['age-max']!=""){
                $agemax= $_POST['age-max'];
            }
            }
            
            if ($stmt = $con->prepare('SELECT * FROM login INNER JOIN infopersos ON login.id = infopersos.user_id WHERE nom LIKE ? and ville LIKE ? and (sexe=? or sexe=? or sexe=?) and pays LIKE ?')) {
                $nom = "%" . $nom . "%";
                $ville = "%" . $ville . "%";
                $pays = "%" . $pays . "%";
                $stmt->bind_param('ssssss', $nom, $ville, $sexe1, $sexe2, $sexe3, $pays);
                $stmt->execute();
                $result = $stmt->get_result();
                $profil = $result->fetch_all(MYSQLI_ASSOC);
            }
            if($agemin>$agemax){
                echo("<h3> L'age demandé n'est pas valide </h3>");
            } else {
                echo("<h3> Voici les résultats correspondant à vos critères </h3>");
                ?>
                <div class="display-result">
                <?php
            foreach($profil as $prof){
                $verif=1;
                if($keyword["0"]!=""){
                    if(sizeof($keyword)!=0){
                        foreach($keyword as $word){
                            if($prof['interets']!=null){
                                if(strpos($prof['interets'],$word)==false || $prof['interets']==null){
                                $verif=0;
                                }
                            } else if ($prof['interets']==null){
                                $verif=0;
                            }
                        }
                    }
                }
                if($prof['dateNaissance']!=null){
                    $birthdate = new DateTime($prof['dateNaissance']);
                    $today = new DateTime('today');
                    $age = $birthdate->diff($today)->y;
                    if($agemin>$age || $agemax<$age ){
                        $verif=0;
                    }
                }
                if($verif==1){
                    echo('<form action="MonProfil.php" method="post">');
                    echo('<input type="hidden" name="username" value="'.$prof['username'].'">');
                    echo('<button type="submit" class="profil-trouvé">');
                    echo('<img src="../../Assets/Client/ProfileImage/'.$prof["imgpath"].'"class="profil-img" width="200" height="200">');
                    echo("<b><p>".$prof['prenom']." ".$prof['nom']."</p></b>");
                    echo("<p><u> Genre:</u> ".$prof['sexe']."</p>");
                    if($prof['dateNaissance']!=null){
                        echo("<p><u> Age:</u> ".$age." ans</p>");
                    }
                    echo("<p>".$prof['ville']."</p>");
                    echo("<p>".$prof['pays']."</p>");
                    echo('</button>');
                    echo('</form>');
                }
            }
            }
                ?>
                </div>
            </div>
    </table>
</div>
</body>
</html>
