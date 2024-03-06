<div class="w-full flex flex-col justify-center items-center">
    <a class="bg-white w-1/2 md:w-1/3 py-8 md:py-6 drop-shadow-xl text-lg my-4 mx-1 rounded-lg flex justify-center items-center" href="<?php echo !empty($_SESSION['code'])? '/play' : '/sessionCode'?>"><span>JOUER</span></a>
    <a class="bg-white w-1/2 md:w-1/3 py-8 md:py-6 drop-shadow-xl text-lg my-4 mx-1 rounded-lg flex justify-center items-center" href='/rules'><span>LES REGLES</span></a>
    <a class="bg-customBlue w-1/2 md:w-1/3 py-8 md:py-6 drop-shadow-xl text-lg my-4 mx-1 rounded-lg flex justify-center items-center" href='/users'><span>ADMIN</span></a>
    <a class="bg-white w-1/2 md:w-1/3 py-8 md:py-6 drop-shadow-xl text-lg my-4 mx-1 rounded-lg flex justify-center items-center cursor-pointer buttonWS" data-action="stopWS">StopWS</a>
</div>
