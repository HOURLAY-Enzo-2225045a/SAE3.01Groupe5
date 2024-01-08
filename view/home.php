<div class="relative w-full flex flex-col justify-center items-center">
    <button class="button" onclick="window.location.href='<?php echo !empty($_SESSION['code'])? '/play' : '/sessionCode'?>'">JOUER</button>
    <button class="button" onclick="window.location.href='/rules'">LES REGLES</button>
    <button class="blueButton" onclick="window.location.href='/users'">ADMIN</button>
</div>
