<div class="h-[40vh] w-full flex flex-col justify-center items-center">
    <button class="button" onclick="window.location.href='/home'">Accueil</button>
    <form id="codeForm" class="flex flex-col" action ="/sessionCode?action=checkSessionCode" method="post">
        <label for="code">Entrez le code :</label>
        <input type="text" id="code" name="code" required>
        <label class="text-red-700"><?= $data?></label>
        <input type="submit" value="Vérifier"/>
    </form>
</div>