<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="flex items-center justify-center w-[50%] translate-x-1/2">
    <form class="test bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" action="" id="form" method="post">
        <input type="hidden" name="action" value="createSpartiate">
        <h1 id="login"> Nouveau Spartiate </h1>
        <label>Nom :<br>
            <input class="rounded-xl" name="lastName" id="lastName" type="text" required/>
        </label>
        <label>Prenom :<br>
            <input class="rounded-xl" name="name" id="name" type="text" required/>
        </label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" name="create" value="Créer">
    </form>
</div>
<?php
var_dump($_FILES);
if(isset($_FILES["fileToUpload"])){
    $target_dir = "fileSave/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // restreindre au extensions d'image
    if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }
}
?>