<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action = "/spartiates?action=updateSpartiate&id=<?= $data->getSpart_id()?>" method="post">
        <h1 id="login">  Mise a jour question Spartiate </h1>
        <label>Nom :</label>
        <input name="lastName" id="lastName" type="text" value="<?= $data->getLastname()?>" required/>
        <label>Prenom :</label>
        <input name="name" id="name" type="text" value="<?= $data->getName()?>" required/>
        <label>Photo :</label>
        <input type="file" id="photo" name="photo" accept="image/*">
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" name="update" value="Mettre a jour">
    </form>
</div>