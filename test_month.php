<?php

require "conf/autoload.php";

/*$maintenant = new DateTime("now", new DateTimeZone('Europe/Paris'));
var_dump($maintenant);
echo $maintenant->format('Y-m-d').'<br>';
echo $maintenant->format('d/m/Y').'<br>';

$annee = (int) $maintenant->format('Y');
echo "Nous sommes en $annee <br>";

$maintenant->modify('+ 1 month');
var_dump($maintenant);

if((bool)$maintenant->format('L')) {
    echo "L'année ".$maintenant->format('Y')." est bissextile";
} else {
    echo "L'année ".$maintenant->format('Y')." n'est pas bissextile";
}*/


// Exercice 1
$now = new DateTimeImmutable("now", new DateTimeZone('Europe/Paris'));

// Exercice 2
$annee_courante = (int) $now->format('Y');
$mois_courant = (int) $now->format('m');
$jour_courant = (int) $now->format('d');

// Exercice 3
$premier = $now->modify('first day of');
//var_dump($premier);

// Exercice 4
$premier_lundi = $premier->modify('first monday of');
//var_dump($premier_lundi);

// Exercice 5
$premier_jour_mois_suivant = $premier->modify('+ 1 month');
//var_dump($premier_jour_mois_suivant);

$dernier_jour_mois_courant = $premier->modify('+ 1 month - 1 day');
//var_dump($dernier_jour_mois_courant);

$premier_annee_suivante = $premier->modify('last day of December')->modify('+ 1 day');
//$premier_annee_suivante = $premier->modify('first day of January')->modify('+ 1 year');
//var_dump($premier_annee_suivante);

$lundi_precedent = ($premier_lundi->format('d') === '01')? $premier_lundi : $premier_lundi->modify('last monday');
//var_dump($lundi_precedent);


//--------------------------------------------------------------------------------------
// Calendrier - POO
//--------------------------------------------------------------------------------------


// Exercice 1 - 2 - 3 - 4
$month = new Month(intval($_GET['month']) ?? $mois_courant, intval($_GET['year']) ?? $annee_courante);

var_dump($month->getFirst());
var_dump($month->getLast());

$view = "views/calendrier.php";

require "template.php";