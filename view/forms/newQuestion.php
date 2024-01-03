<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action = "/adminPages/questions?action=questionCreation" method="post">
        <h1 id="login"> Nouvelle question </h1>
        <label>Question :</label>
        <input type="text" name="text" id="text" required/>
        <label>Niveau :</label>
        <select id="level" name="level" required>
            <option value="attaquant">Attaquant</option>
            <option value="défenseur">Defenseur</option>
            <option value="gardien">Gardien</option>
        </select>
        <input class="bg-blue-500 drop-shadow-xl text-lg py-4 px-8" type="submit" name="create" value="Créer">
    </form>
</div>