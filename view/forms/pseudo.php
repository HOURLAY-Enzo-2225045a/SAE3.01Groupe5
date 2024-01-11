<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="h-[40vh] w-full flex flex-col justify-center items-center space-y-5">
    <form class="flex flex-col" id="form" method="post">
        <input type="hidden" name="action" value="addSessionPlayer">
        <label for="code">Entrez votre pseudo :<br>
            <input class="rounded-xl" type="text" id="pseudo" name="pseudo" required>
        </label>
        <label class="text-red-700"><?= $data?></label>
<div class="text-red-700" id="res"></div>
<input type="submit" value="JOUER"/>
</form>
</div>