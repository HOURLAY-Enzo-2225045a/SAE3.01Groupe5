<?php
$buttonClasses ="bg-white w-1/2 md:w-1/3 py-8 md:py-6 drop-shadow-xl text-lg my-4";
?>

<link rel="stylesheet" href="/assets/rules.css" >

<header>
            <div class="text-container">
                <h1>Bienvenue "Username !"</h1>
                <h2>Ici je vais t’apprendre les basiques du hockey sur glace.</h2>
                <h2>Alors enfile tes patins et c’est partie !</h2>
            </div>
        </header>
        <section class="text-container">
            <p>Le hockey sur glace est un sport qui se pratique à <strong>6 contre 6</strong>, avec <strong>1 gardien</strong> et <strong>5 joueurs</strong> par équipe.</p>
            <p>L’objectif du jeu est de marquer un maximum de buts en envoyant un disque en caoutchouc appelé <strong>palet</strong>, dans le but adverse.</p>
            <p>Pour manipuler le palet, les joueurs utilisent une <strong>crosse de hockey</strong>.</p>
            <p>Le hockey sur glace est le seul sport où les joueurs peuvent se déplacer derrière les buts !</p>
            <p>Le terrain de jeu, appelé patinoire, mesure entre 56 et 60 mètres de long, et entre 26 à 30 mètres de large.</p>
            <p>Il est entouré par des balustrades.</p>
        </section>
        <div class="button-container">
            <button class="left-button" onclick="window.location.href='../Home.php'">Accueil</button>
        </div>
        <div class="right-button-container">
            <button class="right-button" onclick="window.location.href='surface.php'">Suivant</button>
        </div>

        /*<button class="<?php echo $buttonClasses ?>" onclick="window.location.href='/home'">Accueil</button>
        <button class="<?php echo $buttonClasses ?>" onclick="window.location.href='/rules/surface'">Suivant</button>
        */