<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Connexion.php');
    exit;
}
if (isset($_SESSION['isBanned']) && $_SESSION['isBanned'] != 0) {
    header('Location: ../Client/Banni.php');
    exit;
}
include './BackEnd/LoginDatabase.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Assets/Logo/Logo_Fullscreen.png" type="img/png">
    <title>PersonalyTree - Questionnaire</title>
    <link rel="stylesheet" href="../../CSS/Client/Questionnaire.css">
</head>
<?php
include "Header.php";
?>
<body>
    <div class="master">
        <h1>Questionnaire de personnalité</h1>
        <p>Dernière étape avant de pouvoir accéder au site</p>
        <div class="login-container">
            <form action="./BackEnd/ResultatQuestionnaire.php" method="post">
                <h2>1) Quelle est votre approche face aux défis de la vie ?</h2>
                <input type="radio" id="q1default" name="q1" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q1a" name="q1" value="a">
                    <label for="q1a">J'aborde les défis avec optimisme et détermination</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1b" name="q1" value="b">
                    <label for="q1b">Je préfère travailler en équipe pour surmonter les obstacles</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1c" name="q1" value="c">
                    <label for="q1c">Je m'adapte aux défis de manière flexible et pragmatique</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1d" name="q1" value="d">
                    <label for="q1d">Je cherche des solutions créatives aux défis</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1e" name="q1" value="e">
                    <label for="q1e">J'essaie de trouver un équilibre entre les défis et la tranquillité</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1f" name="q1" value="f">
                    <label for="q1f">Je trouve des défis stimulants mais parfois stressants</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1g" name="q1" value="g">
                    <label for="q1g">Je veux surmonter chaque défi avec perfection et précision</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1h" name="q1" value="h">
                    <label for="q1h">Je peux être distrait par les défis mais je m'y adapte</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1i" name="q1" value="i">
                    <label for="q1i">Je cherche des défis simples et minimalistes</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1j" name="q1" value="j">
                    <label for="q1j">Je vois les défis comme des opportunités de croissance personnelle</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q1k" name="q1" value="k">
                    <label for="q1k">Je suis prêt à relever n'importe quel défi et à explorer de nouvelles voies</label>
                </span>
                <br>
                <h2>2) Comment vous détendez-vous après une journée stressante ?</h2>
                <input type="radio" id="q2default" name="q2" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q2a" name="q2" value="a">
                    <label for="q2a">En passant du temps avec mes proches</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2b" name="q2" value="b">
                    <label for="q2b">En sortant et en socialisant avec des amis</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2c" name="q2" value="c">
                    <label for="q2c">En méditant ou en pratiquant le yoga pour me recentrer</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2d" name="q2" value="d">
                    <label for="q2d">En écoutant de la musique relaxante ou en lisant un livre</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2e" name="q2" value="e">
                    <label for="q2e">En prenant soin de moi-même et en me faisant plaisir</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2f" name="q2" value="f">
                    <label for="q2f">En créant un environnement paisible chez moi</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2g" name="q2" value="g">
                    <label for="q2g">En me concentrant sur des activités productives</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2h" name="q2" value="h">
                    <label for="q2h">En explorant de nouveaux passe-temps ou en essayant de nouvelles activités</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2i" name="q2" value="i">
                    <label for="q2i">En simplifiant ma vie et en me débarrassant de l'encombrement</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2j" name="q2" value="j">
                    <label for="q2j">En passant du temps dans la nature et en me connectant à l'extérieur</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q2k" name="q2" value="k">
                    <label for="q2k">En planifiant mon prochain voyage ou en explorant de nouvelles destinations</label>
                </span>
                <br>
                <h2>3) Quelle est votre attitude envers le travail ?</h2>
                <input type="radio" id="q3default" name="q3" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q3a" name="q3" value="a">
                    <label for="q3a">Je suis motivé et enthousiaste à l'idée de travailler</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3b" name="q3" value="b">
                    <label for="q3b">J'apprécie le travail d'équipe et la collaboration</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3c" name="q3" value="c">
                    <label for="q3c">Je préfère travailler de manière indépendante et autonome</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3d" name="q3" value="d">
                    <label for="q3d">Je cherche à développer mes compétences et à m'améliorer constamment</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3e" name="q3" value="e">
                    <label for="q3e">Je valorise l'équilibre entre le travail et la vie personnelle</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3f" name="q3" value="f">
                    <label for="q3f">Je suis prêt à relever les défis professionnels mais j'ai parfois besoin de tranquillité</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3g" name="q3" value="g">
                    <label for="q3g">Je vise l'excellence et la perfection dans tout ce que je fais</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3h" name="q3" value="h">
                    <label for="q3h">Je peux être distrait par d'autres tâches mais je reste adaptable</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3i" name="q3" value="i">
                    <label for="q3i">Je préfère des tâches simples et routinières</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3j" name="q3" value="j">
                    <label for="q3j">Je trouve du sens dans mon travail et je cherche à avoir un impact positif</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q3k" name="q3" value="k">
                    <label for="q3k">Je suis ouvert à de nouvelles opportunités et je cherche à explorer différents domaines</label>
                </span>
                <br>
                <h2>4) Quelle est votre relation avec la nature ?</h2>
                <input type="radio" id="q4default" name="q4" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q4a" name="q4" value="a">
                    <label for="q4a">J'adore passer du temps en plein air et explorer la nature</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4b" name="q4" value="b">
                    <label for="q4b">Je trouve la paix et la tranquillité dans la nature</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4c" name="q4" value="c">
                    <label for="q4c">Je suis attentif à l'environnement et je cherche à le protéger</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4d" name="q4" value="d">
                    <label for="q4d">Je cultive des plantes et j'apprécie le jardinage</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4e" name="q4" value="e">
                    <label for="q4e">Je valorise la simplicité et je trouve la nature apaisante</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4f" name="q4" value="f">
                    <label for="q4f">Je m'engage dans des activités écologiques pour soutenir l'environnement</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4g" name="q4" value="g">
                    <label for="q4g">Je trouve l'inspiration dans la nature pour mes projets artistiques ou créatifs</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4h" name="q4" value="h">
                    <label for="q4h">Je m'adapte facilement aux environnements naturels et changeants</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4i" name="q4" value="i">
                    <label for="q4i">Je préfère un mode de vie minimaliste en harmonie avec la nature</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4j" name="q4" value="j">
                    <label for="q4j">Je suis curieux de découvrir la diversité des écosystèmes et des habitats</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q4k" name="q4" value="k">
                    <label for="q4k">Je suis attiré par les aventures en plein air et les expériences en nature sauvage</label>
                </span>
                <br>
                <h2>5) Comment réagissez-vous face aux situations imprévues ?</h2>
                <input type="radio" id="q5default" name="q5" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q5a" name="q5" value="a">
                    <label for="q5a">Je m'adapte rapidement et je cherche des solutions</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5b" name="q5" value="b">
                    <label for="q5b">Je demande de l'aide à mes proches pour faire face à la situation</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5c" name="q5" value="c">
                    <label for="q5c">Je prends du recul et j'évalue calmement la situation</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5d" name="q5" value="d">
                    <label for="q5d">Je reste calme et je cherche des solutions créatives</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5e" name="q5" value="e">
                    <label for="q5e">Je reste positif et je trouve du réconfort dans les moments difficiles</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5f" name="q5" value="f">
                    <label for="q5f">Je peux être un peu stressé mais je reste calme pour rassurer les autres</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5g" name="q5" value="g">
                    <label for="q5g">Je veux trouver la solution parfaite même dans les situations imprévues</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5h" name="q5" value="h">
                    <label for="q5h">Je peux être distrait par d'autres éléments mais je m'adapte</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5i" name="q5" value="i">
                    <label for="q5i">Je préfère des solutions simples et efficaces pour résoudre les problèmes</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5j" name="q5" value="j">
                    <label for="q5j">Je vois les situations imprévues comme des opportunités d'apprentissage</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q5k" name="q5" value="k">
                    <label for="q5k">Je suis prêt à relever n'importe quel défi et à trouver des solutions innovantes</label>
                </span>
                <br>
                <h2>6) Quel est votre rapport avec les autres ?</h2>
                <input type="radio" id="q6default" name="q6" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q6a" name="q6" value="a">
                    <label for="q6a">Je suis empathique et j'aime aider les autres</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6b" name="q6" value="b">
                    <label for="q6b">J'apprécie les interactions sociales et je suis à l'aise en société</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6c" name="q6" value="c">
                    <label for="q6c">Je préfère des relations profondes avec quelques personnes plutôt que des interactions superficielles</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6d" name="q6" value="d">
                    <label for="q6d">Je suis attentif aux besoins des autres et je suis là pour les soutenir</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6e" name="q6" value="e">
                    <label for="q6e">Je trouve du réconfort dans les relations étroites et les échanges sincères</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6f" name="q6" value="f">
                    <label for="q6f">Je suis là pour soutenir mes amis même dans les moments difficiles</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6g" name="q6" value="g">
                    <label for="q6g">Je veux que chaque interaction soit parfaite et harmonieuse</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6h" name="q6" value="h">
                    <label for="q6h">Je peux être un peu distrait mais je suis présent pour mes amis</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6i" name="q6" value="i">
                    <label for="q6i">Je préfère des relations simples et authentiques plutôt que complexes</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6j" name="q6" value="j">
                    <label for="q6j">Je suis curieux de découvrir de nouvelles personnes et de partager des expériences</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q6k" name="q6" value="k">
                    <label for="q6k">Je suis ouvert à toutes les personnes et j'apprécie les différences culturelles et individuelles</label>
                </span>
                <br>
                <h2>7) Comment décririez-vous votre relation avec votre environnement ?</h2>
                <input type="radio" id="q7default" name="q7" value="" style="display:none;" required>
                <span>
                    <input type="radio" id="q7a" name="q7" value="a">
                    <label for="q7a">J'aime créer un espace chaleureux et accueillant</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7b" name="q7" value="b">
                    <label for="q7b">Je suis attiré par les lieux animés et dynamiques</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7c" name="q7" value="c">
                    <label for="q7c">Je cherche à vivre en harmonie avec mon environnement</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7d" name="q7" value="d">
                    <label for="q7d">Je crée un espace qui reflète ma personnalité et mes intérêts</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7e" name="q7" value="e">
                    <label for="q7e">Je valorise la simplicité et la fonctionnalité dans mon environnement</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7f" name="q7" value="f">
                    <label for="q7f">Je crée un espace de détente et de tranquillité chez moi</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7g" name="q7" value="g">
                    <label for="q7g">Je recherche l'excellence et la perfection dans chaque aspect de mon environnement</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7h" name="q7" value="h">
                    <label for="q7h">Je m'adapte facilement à mon environnement et je trouve des solutions créatives</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7i" name="q7" value="i">
                    <label for="q7i">Je préfère un environnement minimaliste et épuré</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7j" name="q7" value="j">
                    <label for="q7j">Je suis curieux de découvrir de nouveaux environnements et de m'adapter à différentes cultures</label>
                </span>
                <br>
                <span>
                    <input type="radio" id="q7k" name="q7" value="k">
                    <label for="q7k">Je suis prêt à explorer différents environnements et à m'adapter à de nouvelles situations</label>
                </span>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
