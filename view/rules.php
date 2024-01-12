<!--<p>Le hockey sur glace est un sport qui se pratique à 6 contre 6, avec 1 gardien et 5 joueurs par équipe.</p>-->
<!--<p>L’objectif du jeu est de marquer un maximum de buts en envoyant un disque en caoutchouc appelé palet, dans le but adverse.</p>-->
<!--<p>Pour manipuler le palet, les joueurs utilisent une crosse de hockey.</p>-->
<!--<p>Le hockey sur glace est le seul sport où les joueurs peuvent se déplacer derrière les buts !</p>-->
<!--<p>Le terrain de jeu, appelé patinoire, mesure entre 56 et 60 mètres de long, et entre 26 à 30 mètres de large.</p>-->
<!--<p>Il est entouré par des balustrades.</p>-->
<!---->
<a href="/home" class="absolute left-5 top-5 w-10 h-10">
    <img class="p-1" src="/assets/images/home.svg" alt="homepage">
</a>
<div class="h-[40vh]">
    <h1 class="titlePage">
        <span class="text-black">Les</span> règles du jeu
    </h1>

    <!--<div class="max-w-2xl m-auto">-->
    <div id="default-carousel" class="relative" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96 w-4/5 left-[10%]">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <span class="w-full absolute top-1/2 left-1/2 text-2xl font-semibold text-gray-800 -translate-x-1/2 -translate-y-1/2 text-center">
                    Voila la premiere regle du jeu
                    <?php echo file_get_contents('view/rules/equipments.php') ?>
                </span>
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <span class="w-full absolute top-1/2 left-1/2 text-2xl font-semibold text-gray-800 -translate-x-1/2 -translate-y-1/2 text-center">
                    Voila la deuxieme regle du jeu
                    <?php echo file_get_contents('view/rules/game.php') ?>
                </span>
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <span class="w-full absolute top-1/2 left-1/2 text-2xl font-semibold text-gray-800 -translate-x-1/2 -translate-y-1/2 text-center">
                    et la 3eme regle du jeu
                    <?php echo file_get_contents('view/rules/offSide.php') ?>
                </span>
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <span class="w-full absolute top-1/2 left-1/2 text-2xl font-semibold text-gray-800 -translate-x-1/2 -translate-y-1/2 text-center">
                    <?php echo file_get_contents('view/rules/surface.php') ?>
                </span>
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="hidden">Previous</span>
        </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="hidden">Next</span>
        </span>
        </button>
    </div>
</div>
