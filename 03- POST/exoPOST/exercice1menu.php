<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix du plat</title>
</head>
<body>

    <h1>Choisissez un plat :</h1>

    <form method="POST" action="">
        <label for="plat">Sélectionnez votre plat préféré :</label>
        <select name="plat" id="plat">
            <option value="pizza">Pizza</option>
            <option value="sushi">Sushi</option>
            <option value="tacos">Tacos</option>
            <option value="pâtes">Pâtes</option>
            <option value="salade">Salade</option>
        </select>
        <br><br>
        <button type="submit">Valider</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['plat'])) {
        $plat = htmlspecialchars($_POST['plat']); // Sécurisation de la donnée
        echo "<p>Vous avez choisi : <strong>$plat</strong>.</p>";
    }
    ?>

</body>
</html>
