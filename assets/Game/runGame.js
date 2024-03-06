import { Cage } from './Cage.js';
import { Palet } from './Palet.js';
import { CanvasManager } from './CanvasManager.js';
import { CollisionManager } from './CollisionManager.js';
import { EventManager } from './EventManager.js';
import { Game } from './Game.js';

let game = new Game();

//setup du canvas
let canvas = document.getElementById("myCanvas"); // récupération du canvas
// Calculer la nouvelle largeur en fonction de la largeur de la fenêtre
canvas.width = (widthPercentage / 100) * window.innerWidth;
// Calculer la nouvelle hauteur en fonction de la hauteur de la fenêtre
canvas.height = (heightPercentage / 100) * window.innerHeight;
let ctx = canvas.getContext("2d"); // récupération du contexte du canvas
canvas.style.backgroundImage = "url('/assets/images/ice.webp')"; // ajout d'un background au canvas

// Créer un canvas hors écran pour dessiner les éléments statiques une fois
let staticCanvas = document.createElement('canvas');
staticCanvas.width = canvas.width;
staticCanvas.height = canvas.height;