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
    <div class="bg-cover bg-center h-[30vh] w-full relative" style="background-image: url('/assets/images/header.png')">
        <img class="w-1/5 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" src="/assets/images/logo.png" alt="lg-logo" >
        <img class="w-1/5 absolute bottom-0 right-0" src="/assets/images/headerLines.png" alt="headerLines">
        <button class="absolute top-4 right-4 bg-white w-1/4 md:w-1/5 py-1.5 drop-shadow-2xl text-lg" onclick="window.location.href='signUp'">CONNEXION</button>
    </div>
    <?php
}
?>

<?php function end_page(): void
{
    ?>
    <div class="bg-cover bg-center h-[30vh] w-full relative" style="background-image: url('/assets/images/footer.png')">
        <img class="w-1/5 absolute bottom-0 right-0" src="/assets/images/headerLines.png" alt="headerLines.png" >
    </div>
    </body>
<!--    <footer class="">-->
<!--        <p>CC-by 2023-2024 le site </p>-->
<!--    </footer>-->

    </html>
    <?php
}
?>