<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <title>Touché/Coulé - Mise en pratique</title>

        <link rel="stylesheet" type="text/css" href="../../_assets/css/style.css">

        <style type="text/css">
            <!--
            label { display:block; }
            input:not([type="submit"]) { width:150px; }
            -->
        </style>
    </head>
    <body>
        <h1>Touché/Coulé - Mise en pratique</h1>
        <hr />
        <p><em>Pour cet exercice :<br />Nous allons reprendre le plateau de la bataille navale créé dans l'exercice précédent (<a href="09_-_Les_sessions_-_Bataille_navale_lvl1.php" title="Bataille navale - Mise en pratique lvl1">Bataille navale - Mise en pratique lvl1</a>).</em></p>
        <img alt="" src="assets/images/09_-_Les_sessions_-_Bataille_navale.png" />
        <br />
        <p><em>Nous allons le compléter avec la vérification des bateaux "Coulé !".</em></p>
        <ol style="font-style:italic;">
            <li>Créer une fonction/procédure qui stocke les tirs.</li>
            <li>Créer une fonction qui va vérifier s'il reste une case grise autour.<br />Si oui et que la case est "Touché !", vérifier s'il en reste d'autres encore après qui composent le bateau.<br />Si toutes les cases du bateau sont touchées, afficher "Coulé !"</li>
        </ol>

        <form action="" method="POST">
            <label for="txt-lettre">Lettre</label>
            <input id="txt-lettre" name="lettre" type="text" /><br />
            <label for="txt-chiffre">Chiffre</label>
            <input id="txt-chiffre" name="chiffre" type="text" /><br />

            <input type="submit" name="Tirer">
        </form>
    </body>
</html>