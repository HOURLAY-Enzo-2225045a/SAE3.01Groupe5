<h1 class="titlePage">
    <span class="text-black">La</span> page admin
</h1>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href=''">Demarrer</button>
    <button class='button' onclick="window.location.href=''">Arreter</button>
    <button class='button' onclick="window.location.href=''">Reinitialiser</button>
</div>

<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href='/adminPages/spartiates'">Sportifs</button>
    <button class='button' onclick="window.location.href='/adminPages/questions'">Questions</button>
</div>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-4">Classement</h1>
    <table class="w-full table-auto border-collapse">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">Rang</th>
            <th class="px-4 py-2 border">Nom</th>
            <th class="px-4 py-2 border">Score</th>
            <th class="w-1"></th> <!-- Ajouter une colonne vide pour le bouton -->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $user){ ?>
            <tr class="bg-white">
                <td class="px-4 py-2 border-t border-b text-center font-bold">1</td>
                <td class="px-4 py-2 border-t border-b text-center"><?= $user->getPseudo()?></td>
                <td class="px-4 py-2 border-t border-b text-center"><?= $user->getUser_id()?></td>
                <td class="px-4 py-2 border bg-[var(--color-bg)] text-center">
                    <button class="bg-red-500 hover:bg-red-700 text-white rounded p-1">supprimer</button>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>





