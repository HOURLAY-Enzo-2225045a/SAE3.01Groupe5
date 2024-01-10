<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="h-[40vh] w-full flex flex-col justify-center items-center space-y-5">
    <form class="flex flex-col" id="verificationForm" action="/controls/actionController.php" method="post">
        <input type="hidden" name="action" value="checkSessionCode">
        <label for="code">Entrez le code :</label>
        <input class="rounded-xl" type="text" id="code" name="code" required>
        <label class="text-red-700"><?= $data?></label>
        <div class="text-red-700" id="res"></div>
        <input type="submit" value="Vérifier"/>
    </form>
</div>