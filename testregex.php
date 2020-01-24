<?php

$nom1 = 'Lambert';
$nom2 = "L'archevêque";
$nom3 = "zEc58c !!";
$nom4 = "Lemaître";
$nom5 = "Le Maître";
$nom6 = "O"; // secrétaire d'état au numérique

if(preg_match("#^[a-zA-Z'àâäïîéèêôöëùûüçÀÂÉÈÔÙÛÇ\s-]+$#", $nom3)) {
    echo "C'est ok!";
} else {
    echo "C'est PAS ok!";
}