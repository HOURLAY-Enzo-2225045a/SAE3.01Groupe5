<h1 class="titlePage">
    <span class="text-black">Les</span> questions
</h1>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href='/adminPages/users'">Utilisateurs</button>
    <button class='button' onclick="window.location.href='/adminPages/spartiates'">Sportifs</button>
</div>

<div class="flex flex-col items-center justify-center">
    <button class="blueButton" onclick="window.location.href='/newQuestion'">Ajouter une question</button>
    <div class="flex flex-row items-center justify-between w-full px-4 py-2 border-b border-gray-200">
        <input type="text" placeholder="Rechercher" class="w-full px-4 py-2 mr-2 text-gray-700 bg-gray-200 border border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-gray-500">
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">Rechercher</button>
    </div>

    <div class="grid gap-4 p-4">
        <?php foreach($data as $question){ ?>
            <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <div class="flex flex-row items-center justify-between w-full mt-2">
                    <p class="text-lg font-medium text-gray-800 mr-5"><?= $question->getIntitule()?> </p>
                    <div class="flex flex-row space-x-2">
                        <a href="/updateQuestion&id=<?= $question->getQuestion_id() ?>" class="inline-block w-8 h-8 bg-blue-500 hover:bg-blue-700 rounded cursor-pointer">
                            <img class="p-1" src="/assets/images/edit.svg" alt="Delete">
                        </a>
                        <a href="/adminPages/questions?action=deleteQuestion&id=<?= $question->getQuestion_id() ?>" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded cursor-pointer">
                            <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>