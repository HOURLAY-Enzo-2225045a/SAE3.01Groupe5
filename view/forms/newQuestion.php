<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="Delete">
</a>
<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action = "/questions?action=createQuestion" method="post">
        <h1 id="login"> Nouvelle question </h1>
        <label for="text">Question :</label>
        <textarea type="text" name="text" id="text" required></textarea>
        <label for="level">Niveau :</label>
        <select id="level" name="level" required>
            <option value="ATTAQUANT">Attaquant</option>
            <option value="DEFENSEUR">Defenseur</option>
            <option value="GUARDIEN">Gardien</option>
        </select>
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" name="create" value="Créer">
    </form>
</div>