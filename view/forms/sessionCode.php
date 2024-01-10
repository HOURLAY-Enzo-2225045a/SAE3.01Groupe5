<div class="h-[40vh] w-full flex flex-col justify-center items-center space-y-5">
    <button class="button" onclick="window.location.href='/home'">Accueil</button>
    <form id="codeForm" class="flex flex-col verificationForm" action="/controls/actionController.php" method="post">
        <input type="hidden" name="action" value="checkCode">
        <label for="code">Entrez le code :</label>
        <input class="rounded-xl" type="text" id="code" name="code" required>
        <label class="text-red-700"><?= $data?></label>
        <input type="submit" value="Vérifier"/>
    </form>
</div>