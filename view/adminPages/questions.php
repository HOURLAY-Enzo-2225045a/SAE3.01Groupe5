<h1 class="titlePage">
    <span class="text-black">Les</span> questions
</h1>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href='/adminPages'">Admin</button>
    <button class='button' onclick="window.location.href='/adminPages/sportifs'">Sportifs</button>
</div>

<div class="flex flex-col items-center justify-center">
    <button class="button bg-blue-500">Ajouter une question</button>
    <div class="flex flex-row items-center justify-between w-full px-4 py-2 border-b border-gray-200">
        <input type="text" placeholder="Rechercher" class="w-full px-4 py-2 mr-2 text-gray-700 bg-gray-200 border border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-gray-500">
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">Rechercher</button>
    </div>

    <div class="grid gap-4 p-4">
        <?php for($i=0;$i<6;$i++){ ?>
            <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <div class="flex flex-row items-center justify-between w-full mt-2">
                    <p class="text-lg font-medium text-gray-800 mr-5">Etre ou ne pas etre telle est la question Etre ou ne pas etre telle est la questionEtre ou ne pas etre telle est la question </p>
                    <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">modifier</button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>