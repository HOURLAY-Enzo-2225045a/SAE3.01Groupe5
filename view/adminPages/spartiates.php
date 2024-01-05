<h1 class="titlePage">
    <span class="text-black">Les</span> Spartiates
</h1>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href='/adminPages/users'">Utilisateurs</button>
    <button class='button' onclick="window.location.href='/adminPages/questions'">Questions</button>
</div>

<div class="flex flex-col items-center justify-center">
    <button class="blueButton" onclick="window.location.href='/newSpartiate'">Nouveau Joueur</button>
    <div class="flex flex-row items-center justify-between w-full px-4 py-2 border-b border-gray-200">
        <input type="text" placeholder="Rechercher" class="w-full px-4 py-2 mr-2 text-gray-700 bg-gray-200 border border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-gray-500">
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">Rechercher</button>
    </div>

    <div class="grid grid-cols-3 gap-4 p-4">
        <?php foreach($data as $spartiate){ ?>
        <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <img src="https://i.imgur.com/7z9J8ZC.jpg" alt="Marek CILIAK" class="w-32 h-32 rounded-full">
            <div class="flex flex-row items-center justify-between w-full mt-2">
                <p class="text-lg font-medium text-gray-800 mr-5"><?= $spartiate->getLastname()?> <?= $spartiate->getName()?></p>
                <div class="flex flex-row space-x-2">
                    <div class="inline-block w-8 h-8 bg-blue-500 hover:bg-blue-700 rounded cursor-pointer">
                        <img class="p-1 star" data-spartiate-id="<?= $spartiate->getSpart_id() ?>" data-filled="<?= $spartiate->isStarred() ?>" src="<?php echo $spartiate->isStarred() ? '/assets/images/fullStar.svg' : '/assets/images/emptyStar.svg'; ?>" alt="etoile du match">
                    </div>
                    <a href="/updateSpartiate&id=<?= $spartiate->getSpart_id() ?>" class="inline-block w-8 h-8 bg-blue-500 hover:bg-blue-700 rounded">
                        <img class="p-1" src="/assets/images/edit.svg" alt="Edit">
                    </a>
                    <a href="/adminPages/spartiates?action=deleteSpartiate&id=<?= $spartiate->getSpart_id() ?>" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded">
                        <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
