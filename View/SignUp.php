<?php
require 'GestionPage.php';

start_page('Connexion');//Charge la balise "head" avec le css, favicon et le nom de la page donner en parametre.
?>

    <form action="../index.php" method="post">
        <h1 id="login"> INSCRIPTION </h1>
        <br>
        <label>Pseudo :</label>
        <input name="pseudo" id="Pseudo" type="text" />
        <br>
        <label>e-mail :</label>
        <input name="email" id="email" type="email" />
        <br>
        <label>Mot de passe :</label>
        <input name="password" type="password" />

        <label>Confirmez votre mot de passe :</label>
        <input name="password1" type="password" /><br>

        <input type="submit" name="SignUp" value="SignUp"><br>
    </form>

<?php
end_page();
?>