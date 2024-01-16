<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon" />
    <title>%title%</title>
    <!--    style-->
    <link rel="stylesheet" href="/dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/dist/bundle.js"></script>

    <script src="/dist/jquery.min.js"></script>
    <script src="/assets/index.js"></script>
</head>
<body class="bg-[var(--color-bg)] h-[100vh] overflow-hidden fixed w-full">

<a href="/home" class="absolute top-5 left-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="h-[20%] bg-customBlue w-full flex flex-col p-5" id="top">
    <div class="items-center text-3xl text-black text-right">
        <label>Score :</label>
        <label  id="score">0</label>
    </div>
    <div class="h-full flex justify-center items-center">
        <label class="text-5xl text-black text-center" id="question"></label>
    </div>
</div>
<canvas id="myCanvas" class="bg-gray-200 absolute top-[20%] right-1/2 translate-x-1/2"></canvas>
<script src="/assets/game.js"></script>
</body>
</html>