<link rel="stylesheet" href="/assets/common.css" >
<h1>La page admin</h1>

<button onclick="window.location.href=''">Demarrer</button>
<button onclick="window.location.href=''">Arreter</button>
<button onclick="window.location.href=''">Reinitialiser</button>

<button onclick="window.location.href='/admin/sportifs'">Sportifs</button>
<button onclick="window.location.href='/admin/questions'">Questions</button>

<h2>Classement</h2>

<div class="overflow-x-auto">
    <table class="table-auto border-collapse border border-gray-400">
        <thead>
        <tr>
            <th class="px-4 py-2 bg-gray-200 text-gray-600 border border-gray-400">RANG</th>
            <th class="px-4 py-2 bg-gray-200 text-gray-600 border border-gray-400">NOM prénom</th>
            <th class="px-4 py-2 bg-gray-200 text-gray-600 border border-gray-400">SCORES</th>
        </tr>
        </thead>
        <tbody>

            <?php for($i=0;$i<8;$i++){ ?>
            <tr>
                <td class="px-4 py-2 border border-gray-400"> <?=$i?> </td>
                <td class="px-4 py-2 border border-gray-400">NOM prénom</td>
                <td class="px-4 py-2 border border-gray-400">999999</td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>



