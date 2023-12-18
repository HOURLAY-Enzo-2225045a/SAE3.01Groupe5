<link rel="stylesheet" href="/assets/common.css" >


<div class="relative bg-[url('/assets/images/header.png')] bg-center bg-cover h-[25vh] w-full">
    <img src="/assets/images/headerLines.png" alt="headerLines" class="w-1/3 absolute right-0 bottom-0">
    <img src="/assets/images/logo.png" alt="lg-logo" class="w-1/3 md:w-1/5 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
</div>

<h1>La page Sportifs</h1>

<button onclick="window.location.href=''">Demarrer</button>
<button onclick="window.location.href=''">Arreter</button>
<button onclick="window.location.href=''">Reinitialiser</button>

<button onclick="window.location.href='/admin'">Admin</button>
<button onclick="window.location.href='/admin/questions'">Questions</button>

<div class="flex flex-col items-center justify-center">
    <div class="flex flex-row items-center justify-between w-full px-4 py-2 border-b border-gray-200">
        <input type="text" placeholder="Rechercher" class="w-full px-4 py-2 mr-2 text-gray-700 bg-gray-200 border border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-gray-500">
        <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">Ajouter</button>
    </div>
    <div class="grid grid-cols-3 gap-4 p-4">

        <?php for($i=0;$i<6;$i++){ ?>
        <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <img src="https://i.imgur.com/7z9J8ZC.jpg" alt="Marek CILIAK" class="w-32 h-32 rounded-full">
            <div class="flex flex-row items-center justify-between w-full mt-2">
                <p class="text-lg font-medium text-gray-800 mr-5">Marek CILIAK</p>
                <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400 mr-1">SP</button>
                <button class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400">modifier</button>

            </div>
        </div>
        <?php } ?>

    </div>
</div>
