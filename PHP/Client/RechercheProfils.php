<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Client/StylesCommuns.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/Client/Menu_Site.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/Client/RechercheProfils.css">
    <title>PersonaliTree - Rencontre par affinité naturelle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f3;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        p {
            line-height: 1.6;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<?php
include "Header.php";
?>
<body>
    <header>
        <h1>PersonaliTree</h1>
        <p>Rencontrez des personnes partageant votre affinité naturelle à travers une plante ou un arbre.</p>
    </header>
    <div class="filter-bar" id="filter-bar">
        <div class="deroulant">
        <form method="post">
            <table>
                <tr>
                    <th><input type="text" class="filter-searchbar" placeholder="Nom" name="search-nom"><br></th>
                    <th><input type="checkbox" class="checkbox-sex" name="sex1"> <label for="sex1">Homme</label></th>
                </tr>
                <tr>
                    <th><input type="text" class="filter-searchbar" placeholder="Ville" name="search-ville"><br></th>
                    <th><input type="checkbox" class="checkbox-sex" name="sex2"> <label for="sex2">Femme</label></th>
                </tr>
                <tr>
                    <th><input type="text" class="filter-searchbar" placeholder="Pays" name="search-pays"></th>
                    <th><input type="checkbox" class="checkbox-sex" name="sex3"> <label for="sex3">Autre</label></th>
                </tr>
            </table>
            <button name="submit">Rechercher</button>
        </form>
    </div>
    </div>
    <div class="unroll-button" onclick="menu()">
        <script>
            function menu(){
            const menu = document.getElementById("filter-bar");
            if(menu == null){
                console.log("oops");
            }
            menu.classList.add("active");
            }
        </script>
        <p>+</p>
    </div>
    <div class="result">
        <table class="table">

            <?php
            if(isset( $POST['submit'])) {
                $nom=$_POST['search-nom'];
                $ville=$_POST['search-ville'];

                $sql="Select * from infopersos where nom like '%$nom%'";
                $result=mysqli_query($conn,$sql);
                if($result){
                    echo"<p>wow</p>";
                }
            }
            ?>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 PersonaliTree. Tous droits réservés.</p>
    </footer>
</body>
</html>