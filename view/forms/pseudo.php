<a href="/home" class="absolute left-5 top-5 w-20 h-20">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/home.svg" alt="Delete">
</a>
<div class="h-[40vh] w-full flex flex-col justify-center items-center">
    <form class="flex flex-col items-center space-y-5 w-1/2" id="form" method="post">
        <input type="hidden" name="action" value="addSessionPlayer">
        <label for="pseudo"><span class="text-3xl">Entrez votre pseudo :</span>
            <input class="rounded-xl w-full" type="text" id="pseudo" name="pseudo" required>
        </label>
        <input type="submit" value="JOUER" class="text-3xl border-2 border-black rounded-xl w-2/3 md:w-2/5 xl:w-1/6"/>
    </form>
</div>