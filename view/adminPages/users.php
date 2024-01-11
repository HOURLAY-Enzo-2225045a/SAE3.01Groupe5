<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/home.svg" alt="Delete">
</a>
<a class="absolute right-5 top-5 w-10 h-10">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/deconnect.svg" id="deconnect" alt="deconnect">
</a>
<h1 class="titlePage">
    <span class="text-black">La</span> page users
</h1>
<div class="w-full flex justify-center items-center text-4xl"><h2 class="bg-customBlue p-5 rounded-xl" id="code"></h2></div>
<div class="w-full flex flex-row justify-center items-center">
    <a class="button cursor-pointer sessionAction" data-action="start"><span>Demarrer</span></a>
    <a class="button cursor-pointer sessionAction" data-action="stop"><span>Arreter</span></a>
<!--    <a class="sessionAction" data-action="reset"><span>Reinitialiser</span></a>-->
</div>

<div class="w-full flex flex-row justify-center items-center">
    <a class="blueButton" href='/spartiates'><span>Sportifs</span></a>
    <a class="blueButton" href='/questions'><span>Questions</span></a>
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
                    <button id="callActionButton" data-id="<?= $user->getUser_id() ?>" data-modal-target="deleteModalUser" data-modal-toggle="deleteModalUser" class="inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded" type="button">
                        <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                    </button>
                </td>
            </tr>
            <?php $i++;
        } ?>
        </tbody>
    </table>
</div>


<!-- Main modal -->
<div id="deleteModalUser" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 text-center rounded-lg shadow bg-customBlueDark sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-600 hover:text-white" data-modal-toggle="deleteModalUser">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <img class="text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" src="/assets/images/trashcan.svg" </img>
            <p class="mb-4 text-gray-300">Etes vous sur de vouloir supprimer ?</p>
            <div class="flex justify-center items-center space-x-4">
                <button data-modal-toggle="deleteModalUser" type="button" class="py-2 px-3 text-sm font-medium rounded-lg border focus:ring-4 focus:outline-none focus:ring-primary-300 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">
                    Non, annuler
                </button>
                <button data-action="deleteUser" id="actionButton" class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-red-500 hover:bg-red-600 focus:ring-red-900 cursor-pointer">
                    Oui, supprimer
                </button>
            </div>
        </div>
    </div>
</div>








