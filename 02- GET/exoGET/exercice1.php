<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pays</title>
</head>
<body>

    <h1>Choisissez votre pays :</h1>
    
    <ul>
        <li><a href="?pays=France">France</a></li>
        <li><a href="?pays=Canada">Canada</a></li>
        <li><a href="?pays=Japon">Japon</a></li>
        <li><a href="?pays=Brésil">Brésil</a></li>
    </ul>

    <?php
    if (isset($_GET['pays'])) {
        $pays = htmlspecialchars($_GET['pays']); // sécurise la donnée
        switch ($pays) {
            case 'France':
                echo "<p>Vous êtes français.</p>";
                break;
            case 'Canada':
                echo "<p>Vous êtes canadien.</p>";
                break;
            case 'Japon':
                echo "<p>Vous êtes japonais.</p>";
                break;
            case 'Brésil':
                echo "<p>Vous êtes brésilien.</p>";
                break;
            default:
                echo "<p>Pays non reconnu.</p>";
        }
    }
    ?>

</body>
</html>
