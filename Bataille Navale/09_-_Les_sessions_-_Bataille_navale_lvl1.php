<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <title>Bataille navale - Mise en pratique lvl1</title>

        <link rel="stylesheet" type="text/css" href="../../_assets/css/style.css">

        <style type="text/css">
            <!--
            label { display:block; }
            input:not([type="submit"]) { width:150px; }
            -->
        </style>
    </head>
    <body>
        <h1>Bataille navale - Mise en pratique lvl1</h1>
        <hr />
        <p><em>Pour cet exercice :<br />Ci-joint un tableau de 10 cases sur 10</em></p>
        <img alt="" src="assets/images/09_-_Les_sessions_-_Bataille_navale.png" />
        <br />
        <p><em>Vous devez créez une fonction qui prend deux arguments, le premier de type caractère le second de type entier : ce seront les coordonnées horizontales et verticales du tableau.<br />Votre fonction doit retourner trois valeurs différentes :</em></p>
        <ol style="font-style:italic;">
            <li>Si les coordonnées correspondent à une case grise, votre fonction doit afficher touché.</li>
            <li>Si les coordonnées correspondent à une case blanche, votre fonction doit afficher loupé.</li>
            <li>Si les coordonnées ne correspondent à aucune case, votre fonction doit afficher hors-jeu.</li>
        </ol>
        <p>
            <em>Vous pourriez avoir besoin de la fonction PHP "ord()" : // Plus d'infos sur <a href="http://www.php.net/ord" target="_blank" title="">www.php.net/ord</a></em>
            <br /><em>Vous pourriez avoir besoin de la fonction PHP "chr()" : // Plus d'infos sur <a href="http://www.php.net/chr" target="_blank" title="">www.php.net/chr</a></em>
        </p>
        <p class="block alert"><em>Contrainte: Vous ne devez pas dépasser 30 lignes, avec un code correctement indenté (sachant que la construction d'un tableau PHP ne compte que pour 1 ligne et que nous ne compterons pas les lignes d'affichage HTML).</em></p>
        
        <form action="" method="POST">
            <label for="txt-lettre">Lettre</label>
            <input id="txt-lettre" name="lettre" type="text" /><br />
            <label for="txt-chiffre">Chiffre</label>
            <input id="txt-chiffre" name="chiffre" type="text" /><br />

            <input type="submit" name="Tirer">
        </form>
    </body>
</html>