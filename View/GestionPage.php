<?php
session_start();
function start_page($title): void
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
        <title><?php echo $title; ?></title>
    </head>

    <body>
    <?php
}
?>

<?php function end_page(): void
{
    ?>
    </body>

    <footer>
        <small>CC-by 2023-2024 le site </small>
    </footer>

    </html>
    <?php
}
?>

<?php function rules_start_page($title): void   {   ?>
    <header>
        <h1><?php echo $title; ?></h1>
    </header>
<?php   }   ?>

<?php function rules_end_page($precedant, $suivant, $suivantTitre): void   {   ?>
    <section>
        <button onclick="window.location.href='../../index.php'">Retour à l'accueil</button>
        <button onclick="window.location.href='<?php echo $precedant; ?>'">Précédant</button>
        <button onclick="window.location.href='<?php echo $suivant; ?>'"><?php echo $suivantTitre; ?></button>
    </section>
<?php   }   ?>

<?php   function interfaces_view($title, $object, $objectTitle): void   {   ?>
    <h3><?php echo $title; ?></h3>
    <h3 id="Question">Question</h3>
    <section>
        <button id="Answer" name="answer1" onclick="window.location.href='../EndGame/LoseView.php'">Reponse1</button>
        <button id="Answer" name="answer2" onclick="window.location.href='../EndGame/WinView.php'">Reponse2</button>
        <button id="Answer" name="answer3" onclick="window.location.href='../EndGame/LoseView.php'">Reponse3</button>
    </section>
    <section>
        <object id="<?php echo $object; ?>"><?php echo $objectTitle; ?></object>
    </section>
<?php   }   ?>




