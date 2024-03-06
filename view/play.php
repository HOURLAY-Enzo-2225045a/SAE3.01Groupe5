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

    <script type="module" src="/assets/Game/GameDefense.js"></script>
</head>
<body class="bg-[var(--color-bg)] h-[100vh] overflow-hidden fixed w-full">

<a href="/home" class="absolute left-5 top-0 w-20 h-20">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/home.svg" alt="Delete">
</a>
<div class="h-[20%] bg-customBlue w-full flex flex-col p-5" id="top">
    <div class="items-center text-3xl text-black text-right">
        <label>Score :</label>
        <label id="score"></label>
    </div>
    <div class="h-full flex justify-center items-center">
        <label class="text-5xl text-black text-center" id="question"></label>
    </div>
</div>
<div class="w-[68%] ml-[16%] flex items-center justify-between absolute top-[20%] z-10">
    <div class="text-center w-[26.5%]"><label class="text-3xl text-black" id="rep1"></label></div>
    <div class="text-center w-[26.5%]"><label class="text-3xl text-black" id="rep2"></label></div>
    <div class="text-center w-[26.5%]"><label class="text-3xl text-black" id="rep3"></label></div>
</div>
<canvas id="myCanvas" class="bg-gray-200 absolute top-[20%] right-1/2 translate-x-1/2"></canvas>
</body>
</html>