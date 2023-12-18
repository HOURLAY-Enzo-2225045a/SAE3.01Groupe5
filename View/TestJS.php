<?php

require 'GestionPage.php';

start_page('Test JS');   //Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
testJs_view("Test JS");
end_page();