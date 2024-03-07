<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Serious Game de hockey pour les Spartiate de Marseille"/>
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
    <title>%title%</title>
    <!--    style-->
    <link rel="stylesheet" href="/dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/dist/bundle.js"></script>
    <script src="/assets/socket.js"></script>
    <script type="module" src="../assets/GameLauncher.js"></script>
    <script src="/dist/jquery.min.js"></script>
    <script src="/assets/index.js"></script>
    <style>
        body {
            -webkit-user-select: none; /* Désactivation de la sélection sur les navigateurs WebKit/Blink */
            -moz-user-select: none; /* Désactivation de la sélection sur les navigateurs basés sur Gecko (Firefox) */
            -ms-user-select: none; /* Désactivation de la sélection sur Internet Explorer/Edge */
            user-select: none; /* Désactivation de la sélection sur les navigateurs prenant en charge la norme */
        }
    </style>
</head>
<body class="bg-[var(--color-bg)] h-[100vh] overflow-hidden fixed w-full">

<a href="/home" class="absolute left-5 top-0 w-20 h-20">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/home.svg" alt="Delete">
</a>
<a onclick="animationHelper()" class="absolute left-[10%] top-0 w-16 h-16">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/questionMark.svg" alt="Delete">
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
<div class="w-[85%] ml-[7.5%] flex items-center justify-between absolute top-[20%] z-10 min-h-[8%]">
    <div class="text-center w-[29.3%]"><label class="text-3xl text-black" id="rep1"></label></div>
    <div class="text-center w-[29.3%]"><label class="text-3xl text-black" id="rep2"></label></div>
    <div class="text-center w-[29.3%]"><label class="text-3xl text-black" id="rep3"></label></div>
</div>

<canvas id="myCanvas" class="bg-gray-200 absolute top-[20%] right-1/2 translate-x-1/2"></canvas>

<div class="absolute w-full h-full z-50 top-0 bg-customBlueDark opacity-95 flex flex-col items-center justify-center space-y-5 text-white"
     id="endGame" style="display: none">
    <span>
        <label class="text-5xl">Felicitation </label>
        <label class="text-5xl" id="pseudo"></label>
        <label class="text-5xl">!</label>
    </span>
    <span>
        <label class="text-5xl">Score : </label>
        <label class="text-5xl" id="scoreEnd"></label>
    </span>
    <span>
        <label class="text-5xl">Classement : #</label>
        <label class="text-5xl" id="rank"></label>
    </span>
    <a href="/home" class="p-5 bg-customBlue rounded-xl text-4xl">
        Retour à l'accueil
    </a>
</div>
<div class="absolute w-full h-full z-50 top-0 bg-customBlueDark opacity-100 flex flex-col items-center justify-center space-y-5 text-white"
     id="blockLandscape" style="display: none">
    <h1>Tournez votre téléphone</h1>
</div>
<div id="tutorial-hand" class="hand-animation absolute left-[50%] bottom-[20%]" style="display: none"></div>
    <style>
        .hand-animation {
            position: absolute;
            width: 50px;
            height: 50px;
            background-image: url('/assets/images/hand.png'); /* Remplacez 'hand.png' par le chemin de votre image de main */
            background-size: cover;
            animation: handAnimation 2.5s infinite;
        }

        @keyframes handAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(200px);
            }
        }
    </style>
</body>
</html>