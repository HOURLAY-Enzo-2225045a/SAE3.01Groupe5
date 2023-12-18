<?php
function start_page($title): void
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
<!--        <link rel="icon" href="/image/favicon.ico" type="image/x-icon" />-->
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="/assets/output.css">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[var(--color-bg)] h-[100vh]">
    <?php
}
?>

<?php function end_page(): void
{
    ?>
    </body>
<!--    <footer class="">-->
<!--        <p>CC-by 2023-2024 le site </p>-->
<!--    </footer>-->

    </html>
    <?php
}
?>