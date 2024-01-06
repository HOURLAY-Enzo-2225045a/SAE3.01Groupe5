<h1 class="titlePage">
    <span class="text-black">La</span> page users
</h1>
<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="Delete">
</a>
<div class="w-full flex flex-row justify-center items-center">
    <button class='button' onclick="window.location.href=''">Demarrer</button>
    <button class='button' onclick="window.location.href=''">Arreter</button>
    <button class='button' onclick="window.location.href=''">Reinitialiser</button>
</div>

<div class="w-full flex flex-row justify-center items-center">
    <button class='blueButton' onclick="window.location.href='/spartiates'">Sportifs</button>
    <button class='blueButton' onclick="window.location.href='/questions'">Questions</button>

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
        <?php
        $i = 1;
        foreach ($data as $user){ ?>
            <tr class="bg-white">
                <td class="px-4 py-2 border-t border-b text-center font-bold"><?= $i ?></td>
                <td class="px-4 py-2 border-t border-b text-center"><?= $user->getPseudo()?></td>
                <td class="px-4 py-2 border-t border-b text-center"><?= $user->getScore()?></td>
                <td class="p-2 border bg-[var(--color-bg)] text-center">
                    <a href="/users?action=deleteUser&id=<?= $user->getUser_id() ?>" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded">
                        <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                    </a>
                </td>
            </tr>

            <?php $i++;
        } ?>

        </tbody>
    </table>
</div>








