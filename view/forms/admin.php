<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action = "/<?= $_GET["url"] ?? "home"?>?action=logIn" method="post">
        <h1> Connexion </h1>

        <label>Nom d'utilisateur :</label>
        <input name="pseudo" id="pseudo" type="text" />

        <label>Mot de passe :</label>
        <input name="password" id="password" type="password" />

        <label class="text-red-700"><?= $data?></label>
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" id="connexion" name="connexion" value="Se connecter">

    </form>
</div>