<h1 class="titlePage">
    <span class="text-black">La</span> page admin
</h1>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href=''">Demarrer</button>
    <button class='button' onclick="window.location.href=''">Arreter</button>
    <button class='button' onclick="window.location.href=''">Reinitialiser</button>
</div>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href='/adminPages/sportifs'">Sportifs</button>
    <button class='button' onclick="window.location.href='/adminPages/questions'">Questions</button>
</div>

<!--<div class="container mx-auto p-4">-->
<!--    <div class="flex justify-between items-center mb-2">-->
<!--        <input type="text" class="border border-blue-400 rounded px-2 py-1" placeholder="#chercher">-->
<!--        <button class="bg-blue-500 text-white px-4 py-2 rounded">Rechercher</button>-->
<!--    </div>-->
<!--    <div class="bg-gray-100 p-4 rounded">-->
<!--        <div class="grid grid-cols-3 gap-4">-->
<!--            <div class="text-lg font-bold">Classement</div>-->
<!--            <div class="text-lg font-bold">Nom</div>-->
<!--            <div class="text-lg font-bold">Score</div>-->
<!--            <div class="col-start-1 bg-blue-400 rounded p-2">1</div>-->
<!--            <div class="col-start-2  bg-blue-400 rounded p-2">Paul</div>-->
<!--            <div class="col-start-3 flex justify-between items-center">-->
<!--                <span class=" bg-blue-400 rounded p-2">56</span>-->
<!--                <button class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Modifier</button>-->
<!--            </div>-->
<!--            <div class="col-start-1  bg-blue-400 rounded p-2">2</div>-->
<!--            <div class="col-start-2  bg-blue-400 rounded p-2">Emma</div>-->
<!--            <div class="col-start-3 flex justify-between items-center">-->
<!--                <span class=" bg-blue-400 rounded p-2">48</span>-->
<!--                <button class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Modifier</button>-->
<!--            </div>-->
<!--            <div class="col-start-1  bg-blue-400 rounded p-2">3</div>-->
<!--            <div class="col-start-2  bg-blue-400 rounded p-2">Lucas</div>-->
<!--            <div class="col-start-3 flex justify-between items-center">-->
<!--                <span class=" bg-blue-400 rounded p-2">42</span>-->
<!--                <button class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Modifier</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-4">Classement</h1>
    <table class="w-full table-auto border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">Rang</th>
            <th class="px-4 py-2 border">Nom</th>
            <th class="px-4 py-2 border">Score</th>
            <th class="px-4 py-2 border w-1"></th> <!-- Ajouter une colonne vide pour le bouton -->
        </tr>
        </thead>
        <tbody>

        <?php for($i=0;$i<8;$i++){ ?>
        <tr class="bg-white">
            <td class="px-4 py-2 border-t border-b text-center font-bold">1</td>
            <td class="px-4 py-2 border-t border-b text-center">Bob</td>
            <td class="px-4 py-2 border-t border-b text-center">90</td>
            <td class="px-4 py-2 border-t border-b text-center">
                <button class="bg-red-500 hover:bg-red-700 text-white rounded p-1">supprimer</button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>






