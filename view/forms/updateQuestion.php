<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="Delete">
</a>
<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action = "/questions?action=updateQuestion&id=<?= $data->getQuestion_id()?>" method="post">
        <h1 id="login"> Mise a jour question </h1>
        <label>Question :</label>
        <input type="text" name="text" id="text" value="<?=$data->getIntitule()?>" required/>
        <label>Niveau :</label>
        <select id="level" name="level" required>
            <option value="attaquant" <?php if($data->getNiveau() === "ATTAQUANT") echo'selected'?> >Attaquant</option>
            <option value="defenseur" <?php if($data->getNiveau() === "DEFENSEUR") echo'selected'?>>Defenseur</option>
            <option value="gardien" <?php if($data->getNiveau() === "GARDIEN") echo'selected'?>>Gardien</option>
        </select>
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" name="update" value="Mettre a jour">
    </form>
</div>