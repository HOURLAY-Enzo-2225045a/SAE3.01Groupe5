<?php

require '../GestionPage.php';

start_page('Choix difficulté');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>

    <img src="logo.png" alt="Lien-logo site spratiate">
    <button type="button" onclick="window.location.href='ChoixDePoste.php'">Choix du poste</button>
    <section> <!-- Ici on mettra le choix du poste -->
        <button type="button" onclick="window.location.href='AttackInterface.php'">Attaque<img src="photo.png" alt="Photo attaquant"></button>
        <button type="button" onclick="window.location.href='DefenseInterface.php'">Défense<img src="photo.png" alt="Photo défense"></button>
        <button type="button" onclick="window.location.href='GoalkeeperInterface.php'">Gardien<img src="photo.png" alt="Photo guardien"></button>
    </section>

<?php
end_page();
?>