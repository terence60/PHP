<?php

/*

Les exceptions en PHP

Les exceptions en PHP permettent de gérer les erreurs et les conditions anormales de manière contrôlée. Contrairement aux erreurs fatales qui arrêtent le script immédiatement, les exceptions offrent un moyen d'intercepter les erreurs et de les traiter proprement.

On utilisera toujours les exceptions via des blocs try/catch  
Structure de base des exceptions :

    throw : Lance une exception.
    try : Bloc où l'on place le code qui peut potentiellement générer une exception.
    catch : Intercepte une exception lancée et permet de la traiter.

*/

// Je développe ici une fonction qui gère une division entre deux params
function diviser($a, $b)
{
    if ($b == 0) {
        // Ici je défini une condition de division par zero, cest impossible !
        // Plutôt que de déclencher une trigger error basique, je décide plutôt d'instancier une Exception
        // Je gère ici un cas particulier avec une erreur qui est censée se faire "attraper" dans un try/catch
        // Le throw me permet de faire sortir l'objet exception de la fonction, cette exception "lancée" sera récupérée par le catch du bloc try/catch
        // Si je ne mets pas cette instruction dans un try/catch alors cela déclenchera une fatal error "uncaught exception"
        throw new Exception("Division par zéro impossible !");
    }

    return $a / $b;
}

// Sur cette première instruction pas de soucis
echo "Je lance une division 100 par 2, voici son résultat : " . diviser(100, 2) . "<hr>";

// Sur cette deuxième je tombe dans ma condition de la division par zéro ! C'est pour moi un cas d'erreur donc cela déclenche l'exception
// Pour une exception lancée en dehors d'un try catch, cela génère une Fatal Error, le code s'arrête
// echo "Je lance une division 100 par 0, voici son résultat : " . diviser(100,0);


// Le fait de gérer la possibilité d'un lancement d'exception avec un try catch, me permet de gérer l'erreur comme je l'entends et ne pas forcément stopper l'exécution du code par une fatal error 

try {
    echo "Je lance une division 100 par 0, voici son résultat : " . diviser(100, 0);
} catch (Exception $e) {
    echo "<hr>Je suis dans le catch<br>";
    // var_dump($e);
    // var_dump(get_class_methods($e));
    echo $e->getMessage();
    // echo $e->getTraceAsString();
}
echo "<hr>Je suis après le try catch";