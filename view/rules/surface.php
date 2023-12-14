<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
        <link rel="icon" href="/image/favicon.ico" type="image/x-icon" />
        <title>Titre</title>
        <link id="theme" rel="stylesheet" href="../Style/style.css" media="all and (orientation: landscape)"> <!--css pour ecran en paysage-->
    </head>
    <body>
        <header>
            <div class="text-container">
                <h1>Surface de jeu</h1>
            </div>
        </header>
        <section class="text-container">
            <p>La patinoire est divisée en 3 zones, délimitées par 2 lignes bleues: la zone d’attaque, la zone neutre (au milieu) et la zone de défense.</p>
            <p>La zone de défense est comprise entre la balustrade derrière le but défendu par l’équipe et la première ligne bleue. Cette zone comprend également une ligne rouge fine, appelée ligne de but, sur laquelle est placé le but à défendre.</p>
            <p>La zone neutre, quant à elle, est la partie de la patinoire comprise entre les deux lignes bleues. Au milieu de la zone, une ligne rouge aussi épaisse que les lignes bleues symbolise le milieu de la glace et est appelée la ligne rouge centrale. </p>
            <p>Enfin, la zone d’attaque va de la deuxième ligne bleue à la
                bande derrière le but défendu par l’équipe adverse.
                Elle comprend également l’autre ligne de but de la patinoire,
                sur laquelle est positionné le but adverse.</p>
        </section>
        <div class="button-container">
            <button class="left" onclick="window.location.href='../Home.php'">Accueil</button>
        </div>
        <div class="right-button-container">
            <button class="right-button" onclick="window.location.href='rules.php'">Précédent</button>
            <button class="right-button" onclick="window.location.href='equipments.php'">Suivant</button>
        </div>
    </body>
</html>